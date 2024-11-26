<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Positions (show)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @auth
                    <table class="border-collapse table-auto text-sm">
                        <tr>
                            <th>Name</th>
                            <th>Phone number</th>
                        </tr>
                        @foreach ($users as $user)
                            <tr>
                                <td class="border-b">{{$user->name}}</td>
                                <td class="border-b">{{$user->phone_number}}</td>
                            </tr>
                        @endforeach
                    </table>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
