<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users (show)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @auth
                    <table class="border-collapse table-auto w-full text-sm">
                        <tr>
                            <th>Date</th>
                            <th>Room</th>
                            <th>Successful</th>
                        </tr>
                        @foreach ($entries as $entry)
                            <tr>
                                <td class="border-b">{{$entry->created_at}}</td>
                                <td class="border-b">{{$entry->room->name}}</td>
                                <td class="border-b">{{$entry->sucessful === 1 ? 'Yes' : 'No'}}</td>
                            </tr>
                        @endforeach
                    </table>

                    <br>
                    <div>
                        {{$entries->links()}}
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
