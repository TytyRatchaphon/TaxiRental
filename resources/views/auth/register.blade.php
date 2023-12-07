<x-guest-layout>
    <div class="">
        <div class="">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                <!-- First Name -->
                <div class="mb-6">
                    <x-input-label for="F_name" :value="__('First Name')" />
                    <x-text-input id="F_name" class="block w-full mt-1" type="text" name="F_name"
                        :value="old('F_name')" required autofocus />
                    @error('F_name')
                        <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Last Name -->
                <div class="mb-6">
                    <x-input-label for="L_name" :value="__('Last Name')" />
                    <x-text-input id="L_name" class="block w-full mt-1" type="text" name="L_name"
                        :value="old('L_name')" required />
                    @error('L_name')
                        <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- email -->
                <div class="mb-6">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block w-full mt-1" type="email" name="email"
                        :value="old('email')" required />
                    @error('email')
                        <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                 <div class="mb-6">
                    <x-input-label for="id_card_number" :value="__('ID Card')" />
                    <x-text-input id="id_card_number" class="block w-full mt-1" type="text" name="id_card_number"
                        :value="old('id_card_number')" required />
                    @error('id_card_number')
                        <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Profile Image -->
                <div class="">
                    <x-input-label for="user_profile_img" :value="__('Profile Image')" />
                    <x-text-input id="user_profile_img" class="block w-full py-2 px-4 shadow-none" type="file"
                        name="user_profile_img" />
                    @error('user_profile_img')
                        <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- license_id -->
                <div class="mb-6">
                    <x-input-label for="license_id" :value="__('License ID')" />
                    <x-text-input id="license_id" class="block w-full mt-1" type="text" name="license_id"
                        :value="old('license_id')" required />
                    @error('license_id')
                        <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- pb_license -->
                <div class="mb-6">
                    <x-input-label for="pb_license" :value="__('Public License ID')" />
                    <x-text-input id="pb_license" class="block w-full mt-1" type="text" name="pb_license"
                        :value="old('pb_license')" required />
                    @error('pb_license')
                        <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- phone_number -->
                <div class="mb-6">
                    <x-input-label for="phone_number" :value="__('Phone number')" />
                    <x-text-input id="phone_number" class="block w-full mt-1" type="text" name="phone_number"
                        :value="old('phone_number')" required />
                    @error('phone_number')
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

                <!-- ORGANIZTION only can be see by admin -->
                @if(Auth::check() && Auth::user()->role == "ADMIN")
                    <div class="mb-6">
                        <x-input-label for="organization" :value="__('Organization')" />
                        <x-text-input id="organization" class="block w-full mt-1" type="text" name="organization"
                            :value="old('organization')" required />
                        @error('organization')
                            <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                @endif

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-black hover:text-[#F6D106]  rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black"
                        href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ml-4 bg-[#F6D106] hover:bg-yellow-500 hover:scale-105">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
