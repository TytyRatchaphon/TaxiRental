@extends('layouts.main')
@section('content')
<div class="p-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <form method="POST" action="{{ route('profile.update', ['user' => $user]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <!-- Profile Image -->
            <div class="max-w-sm mx-auto overflow-hidden">
                <img id="profileImagePreview"
                    src="{{ asset('storage/' . (old('user_profile_img', $user->user_profile_img) ?: $user->user_profile_img)) }}"
                    class="h-48 w-48 rounded-full border-4 border-yellow-300 mx-auto my-5">
                <x-input-label for="user_profile_img" :value="__('Profile Image')" class="text-center" />
                    <input id="user_profile_img" :value="old('user_profile_img', $user->user_profile_img)" class="block py-2 px-4 shadow-none" type="file" name="user_profile_img" onchange="previewProfileImage(event)" />
                @error('user_profile_img')
                <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <!-- First Name -->
            <div class="mb-6">
                <x-input-label for="user_firstname" :value="__('First Name')" />
                <x-text-input id="user_firstname" class="block w-full mt-1" type="text" name="user_firstname"
                    :value="old('user_firstname', $user->user_firstname)" autofocus />
                @error('user_firstname')
                <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Last Name -->
            <div class="mb-6">
                <x-input-label for="user_lastname" :value="__('Last Name')" />
                <x-text-input id="user_lastname" class="block w-full mt-1" type="text" name="user_lastname"
                    :value="old('user_lastname', $user->user_lastname)"/>
                @error('user_lastname')
                <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Username -->
            <div class="mb-6">
                <x-input-label for="username" :value="__('Username')" />
                <x-text-input id="username" class="block w-full mt-1" type="text" name="username"
                    :value="old('username', $user->username)"/>
                @error('username')
                <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            @if($user->role === "STUDENT")
            <!-- Major -->
            <div class="mb-6">
                <x-input-label for="major" :value="__('Major')" />
                <x-text-input id="major" class="block w-full mt-1" type="text" name="major"
                    :value="old('major', $user->student->major)"/>
                @error('major')
                <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Faculty -->
            <div class="mb-6">
                <x-input-label for="faculty" :value="__('Faculty')" />
                <x-text-input id="faculty" class="block w-full mt-1" type="text" name="faculty"
                    :value="old('faculty', $user->student->faculty)"/>
                @error('faculty')
                <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Year -->
            <div class="mb-6">
                <x-input-label for="year" :value="__('Year')" />
                <x-text-input id="year" class="block w-full mt-1" type="number" name="year"
                    :value="old('year', $user->student->year)" min="1" max="4"/>
                @error('year')
                <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            
            @endif

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                    :value="old('email', $user->email)" autocomplete="username" />
                @error('email')
                <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                    autocomplete="new-password" />

                @error('password')
                <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" autocomplete="new-password" />

                @error('password_confirmation')
                <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-black transition-all hover:text-[#F6D106]  rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black"
                    href="{{ route('login') }}">
                    Back to Profile
                </a>
                <button type="submit" class="ml-4 bg-[#F6D106] rounded-lg px-4 py-1 focus:ring-2 focus:ring-offset-2 focus:ring-[#F6D106] hover:text-white hover:scale-105 transition-all">
                    Save
                <button>
            </div>
        </form>
    </div>
    
</div>

@endsection
<script>
function previewProfileImage(event) {
    const previewImage = document.getElementById('profileImagePreview');
    const selectedFile = event.target.files[0];

    if (selectedFile) {
        const objectURL = URL.createObjectURL(selectedFile);
        previewImage.src = objectURL;
    } else {
        previewImage.src = "{{ asset('storage/' . $user->user_profile_img) }}";
    }
}
</script>