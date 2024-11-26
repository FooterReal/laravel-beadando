<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Positions (edit)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @auth
                    @if ($isadmin)
                    <form class="flex flex-col gap-4" action="{{ route('positions.update', $id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="thor-input-field" value="{{ old('name', $name) }}">
                        @error('name')
                            <div class="text-red-500">Name error: {{ $message }}</div>
                        @enderror

                        <button type="submit" class="p-2 bg-blue-500 hover:bg-blue-900 text-black rounded-lg shadow-sm">Send</button>
                    </form>

                    @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

