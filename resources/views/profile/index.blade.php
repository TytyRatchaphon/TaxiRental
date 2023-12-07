@extends('layouts.main')
@section('content')
<div class="p-10 bg-gradient-to-r from-[#f75394] to-yellow-300">
    <div class="max-w-sm mx-auto bg-white rounded-lg overflow-hidden shadow-lg">
        <div class="border-b p-20">
            <div class="text-center">
                @if ($user->user_profile_img)
                    <img src="{{ asset('/storage/' . ($user->user_profile_img))}}" alt="Profile Image" class="h-48 w-48 rounded-full border-4 border-yellow-300 mx-auto my-5">
                @else
                <img src="{{ asset('default-img/user_image.jpg') }}" alt="Default Event Image" class="h-48 w-48 rounded-full border-4 border-yellow-300 mx-auto my-5">
                @endif
                <div class="py-5">
                    <h3 class="font-bold text-2xl mb-1">
                        {{ $user->F_name }}
                        {{ $user->L_name }}
                    </h3>
                    <div class="inline-flex text-gray-700 items-center">
                        {{ $user->username }}
                    </div>
                    @if (!Auth::user()->isRole('ADMIN') && !Auth::user()->isRole('OPERATOR') )
                    @endif  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection