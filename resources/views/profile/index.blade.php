@extends('layouts.main')
@section('content')
<div class="p-10 bg-gradient-to-r from-[#f75394] to-yellow-300">
    <div class="max-w-sm mx-auto bg-white rounded-lg overflow-hidden shadow-lg">
        <div class="border-b p-20">
            <div class="text-center">
                @if ($user->user_profile_img)
                    <img src="{{ asset('/storage/' . ($user->user_profile_img))}}" alt="Profile Image" class="h-48 w-48 rounded-full border-4 border-yellow-300 mx-auto my-5">
                @else
                    <img src="https://cdn.discordapp.com/attachments/1132651254057795625/1143232398243397733/user_image.jpeg" alt="Default Event Image" class="h-48 w-48 rounded-full border-4 border-yellow-300 mx-auto my-5">
                @endif
                <div class="py-5">
                    <h3 class="font-bold text-2xl mb-1">
                        {{ $user->user_firstname }}
                        {{ $user->user_lastname }}
                    </h3>
                    <div class="inline-flex text-gray-700 items-center">
                        {{ $user->username }}
                    </div>
                    @if (!Auth::user()->isRole('ADMIN') && !Auth::user()->isRole('OPERATOR') )
                    <div class="text-center m-5">
                        <a href="{{ route('profile.edit', ['user' => $user]) }}"
                            class="p-2 px-5 text-sm text-purple-600 font-semibold rounded-full border border-purple-200 hover:text-white hover:bg-purple-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2">
                            Edit Profile
                        </a>
                    </div>
                    @endif  
                </div>
            </div>
        </div>
        @if($user->role === "STUDENT")
        <div class="p-10 pt-5">
            <div class="flex flex-col space-y-3 py-5">
                <div class="flex bg-yellow-300 rounded-xl px-3 items-center">
                        <p class="font-semibold px-1">{{ $user->student->major }}</p>
                </div>
                <div class="flex bg-yellow-300 rounded-xl px-3 items-center">
                    <p class="font-semibold px-1">{{ $user->student->faculty }}</p>
                </div>
                <div class="flex bg-yellow-300 rounded-xl px-3 items-center">
                    <p class="font-semibold px-1">Year {{ $user->student->year }}</p>
                </div>
            </div>
            <div class="flex flex-col bg-white overflow-hidden">
                <h1 class="text-xl font-semibold">Contact</h1>
                <div class="p-3">
                    @if($user->student->facebook)
                    <p class="font-semibold">Facebook
                        {{ $user->student->facebook }}</p>
                    @else
                    <p class="font-semibold">Facebook (private)</p>
                    @endif

                    @if($user->student->line)
                    <p class="font-semibold">Line {{ $user->student->line }}</p>
                    @else
                    <p class="font-semibold">Line (private)</p>
                    @endif

                    @if($user->student->instagram)
                    <p class="font-semibold">Instagram {{ $user->student->instagram }}</p>
                    @else
                    <p class="font-semibold">Instagram (private)</p>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection