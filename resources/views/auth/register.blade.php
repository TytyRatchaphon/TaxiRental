<x-guest-layout>
    <div class="flex justify-center">
        <div class="w-full sm:w-96 bg-white dark:bg-black p-8 rounded-lg shadow-md">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <!-- First Name -->
                <div class="mb-6">
                    <x-input-label for="user_firstname" :value="__('First Name')" />
                    <x-text-input id="user_firstname" class="block w-full mt-1" type="text" name="user_firstname"
                        :value="old('user_firstname')" required autofocus />
                    @error('user_firstname')
                        <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Last Name -->
                <div class="mb-6">
                    <x-input-label for="user_lastname" :value="__('Last Name')" />
                    <x-text-input id="user_lastname" class="block w-full mt-1" type="text" name="user_lastname"
                        :value="old('user_lastname')" required />
                    @error('user_lastname')
                        <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Username -->
                <div class="mb-6">
                    <x-input-label for="username" :value="__('Username')" />
                    <x-text-input id="username" class="block w-full mt-1" type="text" name="username"
                        :value="old('username')" required />
                    @error('username')
                        <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Profile Image -->
                <div class="mb-6">
                    <x-input-label for="user_profile_img" :value="__('Profile Image')" />
                    <x-text-input id="user_profile_img" class="block w-full mt-1" type="file"
                        name="user_profile_img" />
                    @error('user_profile_img')
                        <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Major -->
                <div class="mb-6">
                    <x-input-label for="Major" :value="__('Major')" />
                    <x-text-input id="Major" class="block w-full mt-1" type="text" name="Major"
                        :value="old('Major')" required />
                    @error('Major')
                        <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Faculty -->
                <div class="mb-6">
                    <x-input-label for="Faculty" :value="__('Faculty')" />
                    <x-text-input id="Faculty" class="block w-full mt-1" type="text" name="Faculty"
                        :value="old('Faculty')" required />
                    @error('Faculty')
                        <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Year -->
                <div class="mb-6">
                    <x-input-label for="Year" :value="__('Year')" />
                    <x-text-input id="Year" class="block w-full mt-1" type="number" name="Year"
                        :value="old('Year')" min="1" max="4" required />
                    @error('Year')
                        <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autocomplete="username" />
                    @error('email')
                        <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />

                    @error('password')
                        <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />

                    @error('password_confirmation')
                        <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ml-4 bg-yellow-500 hover:bg-yellow-600">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
