@extends('layouts.main')
@section('content')
<div class="p-5">
    <ul class="flex flex-col justify-center items-center">
        <li class="flex flex-col bg-white rounded-lg shadow-lg overflow-hidden max-w-3xl w-full mb-5">
            <div class="flex m-5">
                <img src="https://images.unsplash.com/photo-1454496522488-7a8e488e8606" alt="Avatar"
                    class="w-32 h-32 rounded-full mr-2 object-cover">
                <div class="m-5 mt-2 mb-0">
                    <h1 class="text-xl leading-tight font-semibold mb-2">ชื่อกิจกรรม</h1>
                    <p class="text-gray-700 leading-tight">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Aliquam eu sapien porttitor, blandit velit ac,
                        vehicula elit. Nunc et ex at turpis rutrum viverra.
                    </p>
                </div>
            </div>
            <hr>
            <div class="object-cover m-20 mt-5 mb-5">
                <img src="https://images.unsplash.com/photo-1454496522488-7a8e488e8606" alt="Mountain"
                    class="rounded-lg w-full alsolute">
                <div class="bg-black h-64 absolute">
                </div>
            </div>
        </li>
        <li class="flex flex-col bg-white rounded-lg shadow-lg overflow-hidden max-w-3xl w-full mb-5">
            <div class="flex m-5">
                <img src="https://images.unsplash.com/photo-1454496522488-7a8e488e8606" alt="Avatar"
                    class="w-32 h-32 rounded-full mr-2 object-cover">
                <div class="m-5 mt-2 mb-0">
                    <h1 class="text-xl font-semibold mb-2">ชื่อกิจกรรม</h1>
                    <p class="text-gray-700 leading-tight">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Aliquam eu sapien porttitor, blandit velit ac,
                        vehicula elit. Nunc et ex at turpis rutrum viverra.</p>
                </div>
            </div>
            <hr>
            <div class="object-cover m-20 mt-5 mb-5">
                <img src="https://images.unsplash.com/photo-1454496522488-7a8e488e8606" alt="Mountain"
                    class="rounded-lg w-full">
            </div>
        </li>
    </ul>
</div>


@endsection