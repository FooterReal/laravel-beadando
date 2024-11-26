<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users (index)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @auth
                    <table class="border-collapse table-auto w-full text-sm">
                        <tr>
                            <th>Name</th>
                            <th>Job</th>
                            <th>Phone</th>
                        </tr>
                        @foreach ($users as $user)
                            <tr>
                                <td class="border-b">{{$user->name}}</td>
                                <td class="border-b">{{$user->position->name}}</td>
                                <td class="border-b">{{$user->phone_number}}</td>
                                @if ($isadmin)
                                    <td class="border-b"><a class="text-blue-600 hover:text-blue-800 visited:text-purple-600 rounded-lg shadow-sm mt-4" href="{{route('users.edit', $user->id)}}">Edit</a>
                                    <td class="border-b"><a class="text-blue-600 hover:text-blue-800 visited:text-purple-600 rounded-lg shadow-sm mt-4" href="{{route('users.show', $user->id)}}">History</a>
                                    <td class="border-b">
                                        <form class="flex flex-col gap-4" action="{{ route('users.delete', $user->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="p-2 bg-blue-500 hover:bg-blue-900 text-black rounded-lg shadow-sm">Delete</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </table>

                    <div class="py-6">
                        <a
                            href="{{ route('users.create') }}"
                            class="text-blue-600 hover:text-blue-800 visited:text-purple-600 rounded-lg shadow-sm mt-4"
                        >New user</a>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
