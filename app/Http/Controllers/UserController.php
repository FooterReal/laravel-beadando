<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\User;
use App\Models\UserRoomEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $isadmin = User::all()->where('id','=',Auth::id())->first()->admin;

        $users = User::all();
        return view('users.index', [
            'users' => $users,
            'isadmin' => $isadmin
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $isadmin = User::all()->where('id','=',Auth::id())->first()->admin;

        if (!$isadmin) {
            return abort(403);
        }

        $positions = Position::all();

        return view('users.create', [
            'isadmin' => $isadmin,
            'positions' => $positions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'name' => 'required',
            'pos' => 'required|exists:positions,id',
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'required',
            'card' => 'required|min:16|max:16|regex:/[a-zA-Z0-9]+/i'
        ],
        [
            'required' => 'This field is not optional: :attribute'
        ]);

        $isadmin = User::all()->where('id','=',Auth::id())->first()->admin;

        if (!$isadmin) {
            return abort(403);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
            'phone_number' => $request->phone,
            'card_number' => $request->card,
            'position_id' => $request->pos
        ]);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $isadmin = User::all()->where('id','=',Auth::id())->first()->admin;

        if (!$isadmin) {
            return abort(403);
        }

        $entries = UserRoomEntry::where('user_id','=',$id)->paginate(10);

        return view('users.show', [
            'entries' => $entries
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $isadmin = User::all()->where('id','=',Auth::id())->first()->admin;

        if (!$isadmin) {
            return abort(403);
        }

        $user = User::findOrFail($id);
        $positions = Position::all();

        return view('users.edit', [
            'id' => $id,
            'name' => $user->name,
            'pos' => $user->position_id,
            'email' => $user->email,
            'phone' => $user->phone_number,
            'card' => $user->card_number,
            'isadmin' => $isadmin,
            'positions' => $positions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'name' => 'required',
            'pos' => 'required|exists:positions,id',
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'required',
            'card' => 'required|min:16|max:16|regex:/[a-zA-Z0-9]+/i'
        ],
        [
            'required' => 'This field is not optional: :attribute'
        ]);

        $isadmin = User::all()->where('id','=',Auth::id())->first()->admin;

        if (!$isadmin) {
            return abort(403);
        }

        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
            'phone_number' => $request->phone,
            'card_number' => $request->card,
            'position_id' => $request->pos
        ]);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $isadmin = User::all()->where('id','=',Auth::id())->first()->admin;

        if (!$isadmin) {
            return abort(403);
        }

        User::destroy($id);

        return redirect()->route('users.index');
    }
}
