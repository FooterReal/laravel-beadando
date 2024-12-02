<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Positions (index)') }}
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
                            <th>Num. of users</th>
                            <th>Rooms</th>
                        </tr>
                        @foreach ($positions as $position)
                            <tr>
                                <td class="border-b">{{$position->name}}</td>
                                <td class="border-b">{{$position->users->count()}}</td>
                                <td class="border-b">{{join(', ',$position->rooms->pluck('name')->toArray())}}</td>
                                <td class="border-b"><a class="text-blue-600 hover:text-blue-800 visited:text-purple-600 rounded-lg shadow-sm mt-4" href="{{route('positions.show', $position->id)}}">Users</a>
                                @if ($isadmin)
                                    <td class="border-b"><a class="text-blue-600 hover:text-blue-800 visited:text-purple-600 rounded-lg shadow-sm mt-4" href="{{route('positions.edit', $position->id)}}">Edit</a>
                                    <td class="border-b">
                                        <form class="flex flex-col gap-4" action="{{ route('positions.delete', $position->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="p-2 bg-blue-500 hover:bg-blue-900 text-black rounded-lg shadow-sm">Delete</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </table>

                    @if ($isadmin)
                    <div class="py-6">
                        <a
                            href="{{ route('positions.create') }}"
                            class="text-blue-600 hover:text-blue-800 visited:text-purple-600 rounded-lg shadow-sm mt-4"
                        >New position</a>
                    </div>
                    @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
