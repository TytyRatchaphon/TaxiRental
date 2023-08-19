@extends('layouts.main')

@section('content')
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="container">
                <form method="POST" action="{{ route('operators.store') }}">
                    @csrf

                    <!-- Profile Image 
                    <div class="mb-6">
                        <x-input-label for="user_profile_img" :value="__('Profile Image')" />
                        <input type="file" class="block w-full mt-1 form-input" id="user_profile_img" name="user_profile_img" 
                            required />
                    </div>
                    -->
                    <!-- First Name -->
                    <div class="mb-6">
                        <x-input-label for="user_firstname" :value="__('First Name')" />
                        <input type="text" class="block w-full mt-1 form-input" id="user_firstname" name="user_firstname"
                            required autofocus />
                    </div>

                    <!-- Last Name -->
                    <div class="mb-6">
                        <x-input-label for="user_lastname" :value="__('Last Name')" />
                        <input type="text" class="block w-full mt-1 form-input" id="user_lastname" name="user_lastname"
                            required />
                    </div>

                    <!-- Username -->
                    <div class="mb-6">
                        <x-input-label for="username" :value="__('Username')" />
                        <input type="text" class="block w-full mt-1 form-input" id="username" name="username"
                            required />
                    </div>

                    <!-- Email -->
                    <div class="mb-6">
                        <x-input-label for="email" :value="__('Email')" />
                        <input type="email" class="block w-full mt-1 form-input" id="email" name="email"
                            required />
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <x-input-label for="password" :value="__('Password')" />
                        <input type="password" class="block w-full mt-1 form-input" id="password" name="password"
                            required />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <input type="password" class="block w-full mt-1 form-input" id="password_confirmation"
                            name="password_confirmation" required />
                    </div>

                    <!-- Organization -->
                    <div class="mb-6">
                        <x-input-label for="organization" :value="__('Organization')" />
                        <input type="text" class="block w-full mt-1 form-input" id="organization" name="organization"
                            required />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-black hover:text-[#F6D106] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black"
                            href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <button type="submit"
                            class="ml-4 bg-[#F6D106] hover:bg-yellow-500 hover:scale-105 py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
                            {{ __('Register') }}
                        </button>
                </form>
            </div>
        </div>
    </div>
@endsection
