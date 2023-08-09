@extends('layouts.main')
@section('content')
<div class="flex justify-center p-10">
    <div class="bg-white shadow-lg rounded-lg max-w-5xl w-full p-10">
        <h1 class="text-2xl p-5">Add Event</h1>
        <hr>
        <div class="flex flex-col overflow-hidden mt-5">
            <div class="flex">
                <div class="flex flex-col w-4/5 p-3">
                    <label for="" class="pb-1">Event Title</label>
                    <input type="text" name="" id="" class="w-full">
                </div>
                <div class="flex flex-col w-1/5 p-3">
                    <label for="" class="pb-1">Participants Limit</label>
                    <input type="number" name="" id="" class="w-full">
                </div>
            </div>
            <div class="flex flex-col w-full p-3">
                <label for="" class="pb-1">Detail</label>
                <input type="text" name="" id="" class="w-full h-40">
            </div>
            <div class="flex flex-col  p-3">
                <label for="" class="pb-3">Add Image</label>
                <input type="image" src="https://images.unsplash.com/photo-1454496522488-7a8e488e8606" alt="" class="h-64 w-full hover:opacity-80 rounded-lg border-yellow-200">
            </div>
            <div class="flex mt-3 mb-5">
                <div class="flex items-center w-1/2 pl-3">
                    <label for="" class="pr-3">วันเริ่มกิจกรรม</label>
                    <input type="date" name="" id="">
                </div>
                <div class="flex items-center w-1/2">
                    <label for="" class="pr-3">สมัครภายในวันที่</label>
                    <input type="date" name="" id="">
                </div>
            </div>
            <div class="flex mt-10">
                    <button type="submit" class="bg-[#F6D106] p-2 mr-5 rounded-lg w-32 hover:opacity-80">เพิ่มกิจกรรม</button>
                    <button class="bg-[#FF6666] p-2 rounded-lg w-24 hover:opacity-80">ยกเลิก</button>
            </div>    
        </div>
    </div>
</div>
@endsection