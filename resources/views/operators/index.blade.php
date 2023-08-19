@extends('layouts.main')
@section('content')
    <div class="flex justify-center p-10">
        <div class="flex flex-col w-full">
            <div>
                <div class="flex justify-between mb-5">
                    <div class="">
                        <h1 class="text-2xl">Operator List</h1>
                    </div>

                    <!-- Only Admin -->
                    <div class="">
                        <form action="{{ route('operators.search') }}" method="get">
                            @csrf
                            @method('GET')
                            <input class="" type="text" name="input" placeholder="Search Operator">
                            <button type="submit"
                                class="z-50 drop-shadow bg-white text-gray-400 transition duration-300 hover:text-[#F6D106] rounded-r-lg py-[8.7px] px-4">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
            <div class="justify-between mb-3">
                <div class="flex items-center w-11/12">
                    <div class="w-3/12">
                        <h1>Username</h1>
                    </div>
                    <div class="w-6/12">
                        <h2>Firstname - Lastname</h2>
                    </div>
                </div>
            </div>
            @if (!$operators->isEmpty())
                <ul class="flex-col">
                    @foreach ($operators as $operator)
                        <li class="flex mb-3">
                            <div class="flex bg-white rounded-lg shadow-lg w-full p-3 items-center justify-between">
                                <div class="flex w-full items-center">
                                    <div class="flex items-center w-3/12">
                                        <img src="{{ asset('/storage/' . $operator->user_profile_img) }}" alt="profile_img"
                                            class="w-8 h-8 rounded-full mr-2 object-cover">
                                        <span class="text-gray-800 font-semibold mr-5">{{ $operator->username }}</span>
                                    </div>
                                    <div class="">
                                        <h1 class="font-semibold">{{ $operator->user_firstname }}
                                            {{ $operator->user_lastname }}
                                        </h1>
                                    </div>
                                </div>
                                <!-- Only Admin -->
                                <form action="{{ route('operators.destroy', ['operator' => $operator]) }}" method="post"
                                    class="flex ml-5 items-center justift-center">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-400 rounded-full px-4 py-1 mr-2 hover:opacity-90 hover:text-white">Remove</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="flex bg-white rounded-lg shadow-lg w-full p-3 items-center justify-center">
                    <h1 class="text-center text-gray-300 py-10">Not have Operator</h1>
                </div>
            @endif
        </div>
    </div>
@endsection
