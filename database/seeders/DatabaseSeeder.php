<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Position;
use App\Models\Room;
use App\Models\UserRoomEntry;
use Illuminate\Container\Attributes\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function Laravel\Prompts\form;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $positions = Position::factory(4)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'admin' => true,
            'position_id' => $positions[0]->id
        ]);

        for ($i=0; $i < 10; $i++) {
            User::factory()->for($positions->random())->create();
        }

        $rooms = Room::factory(5)->create();
        $users = User::all();

        foreach($rooms as $room) {
            $room_positions = $positions->random(random_int(1, $positions->count()));

            for ($i=0; $i < 20; $i++) {
                UserRoomEntry::factory()->for($room)->for($users->random())->create();
            }

            foreach ($room_positions as $position) {
                $room->positions()->attach($position->id);
            }
        }

        $entries = UserRoomEntry::all();
        foreach ($entries as $entry) {
            $room_pos_ids = $entry->room->positions->pluck('id')->toArray();
            $user_pos_id = $entry->user->position->id;

            $canEnter = in_array($user_pos_id, $room_pos_ids);

            $entry->update(['successful' => $canEnter != null]);
        }
    }
}
