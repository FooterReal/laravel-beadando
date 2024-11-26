<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users (create)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @auth
                    @if ($isadmin)
                    <form class="flex flex-col gap-4" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="thor-input-field" value="{{ old('name', '') }}">
                        @error('name')
                            <div class="text-red-500">Name error: {{ $message }}</div>
                        @enderror

                        <label for="pos">Position<label>
                        <select name="pos" id="pos" class="thor-input-field">
                            @foreach ($positions as $position)
                                <option value="{{$position->id}}" {{ $position->id == old('pos',-1) ? 'selected="selected"' : ''}}>{{$position->name}}</option>
                            @endforeach
                        </select>
                        @error('pos')
                            <div class="text-red-500">Position error: {{ $message }}</div>
                        @enderror
                        <br><br>

                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="thor-input-field" value="{{ old('email', '') }}">
                        @error('email')
                            <div class="text-red-500">Email error: {{ $message }}</div>
                        @enderror
                        <br><br>

                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="thor-input-field" value="">
                        @error('name')
                            <div class="text-red-500">Password error: {{ $message }}</div>
                        @enderror
                        <br><br>

                        <label for="phone">Phone number</label>
                        <input type="text" name="phone" id="phone" class="thor-input-field" value="{{ old('phone', '') }}">
                        @error('phone')
                            <div class="text-red-500">Phone error: {{ $message }}</div>
                        @enderror
                        <br><br>

                        <label for="card">Card number</label>
                        <input type="text" name="card" id="card" class="thor-input-field" value="{{ old('card', '') }}">
                        @error('card')
                            <div class="text-red-500">Card error: {{ $message }}</div>
                        @enderror
                        <br><br>

                        <button type="submit" class="p-2 bg-blue-500 hover:bg-blue-900 text-black rounded-lg shadow-sm">Send</button>
                    </form>

                    @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

