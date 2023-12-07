@extends('layouts.main')

@section('content')
<div class="flex justify-center lh-10">
    <div class="bg-white shadow-lg rounded-lg max-w-5xl w-full p-10">
        <h1 class="text-2xl p-5">Edit Taxi info</h1>
        <hr>
        <form action="{{ route('events.update',['taxi' => $taxi]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex flex-col overflow-hidden mt-5">
                <div class="flex">
                    <div class="flex flex-col w-4/5 p-3">
                        <label for="car_license" class="pb-1">Car License</label>
                        <input type="text" name="car_license" id="car_license" class="w-full" value="{{old('car_license', $taxi)}}">
                        @error('car_license')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col w-1/5 p-3">
                        <label for="registration_no" class="pb-1">Registration Number</label>
                        <input type="text" name="registration_no" id="registration_no" class="w-full" value="{{old('registration_no', $taxi)}}">
                        @error('registration_no')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-col w-full p-3">
                    <label for="car_color" class="pb-1">Car color</label>
                    <input type="text" name="car_color" id="car_color" class="w-full" value="{{old('car_color', $taxi)}}">
                    @error('car_color')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col w-full p-3">
                    <label for="car_model" class="pb-1">Car Model</label>
                    <input type="text" name="car_model" id="car_model" class="w-full" value="{{old('car_model', $taxi)}}">
                    @error('car_model')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col  p-3">
                    <label for="car_image" class="pb-3">Add Images</label>
                    <input type="file" name="car_image" id="car_image" class="h-64 w-full hover:opacity-80 rounded-lg cursor-pointer border-yellow-200" value="{{old('car_image', $taxi)}}">
                    @error('car_image')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex mt-10">
                    <button type="submit" class="bg-[#F6D106] p-2 mr-5 rounded-lg w-32 hover:opacity-80" onclick="return confirm('Are you sure you want to UPDATE TAXI INFO?')">Save</button>
                    
                    <a href="{{ route('events.index') }}" class="bg-[#FF6666] p-2 rounded-lg w-24 hover:opacity-80">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
