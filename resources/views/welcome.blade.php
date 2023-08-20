@extends('layouts.main')

@section('title', 'Welcome')

@section('content')
    <header class="bg-gradient-to-r from-[#f75394] to-yellow-300 rounded drop-shadow text-white py-16 text-center">
        <h1 class="drop-shadow text-3xl md:text-5xl transition-all font-semibold translate-y-12 duration-500 opacity-0"  data-replace='{ "translate-y-12": "translate-y-0", "opacity-0": "opacity-100" }'>WELCOME TO EVENT MANAGEMENT SYSTEM</h1>
        <p class="drop-shadow mt-4 text-[2.2vh] md:text-xl transition-all translate-y-12 duration-300 opacity-0" data-replace='{ "translate-y-12": "translate-y-0", "opacity-0": "opacity-100" }'>Manage and organize your events with ease</p>
        <a href="{{ url('/home') }}"
            class="drop-shadowtransition-transform duration-1000 hover:duration:300 hover:scale-110 mt-8 px-8 py-4 bg-[#F6D106] text-white font-medium rounded-lg inline-block hover:bg-yellow-400 opacity-0 " data-replace='{ "opacity-0": "opacity-100" }'>Get
            Started</a>
    </header>

    <div class="my-2 m-auto max-w-screen-xl mx-auto">
        <div class="container mt-8">    
            <h2 class="text-3xl font-semibold">About Us</h2>
            <p class="mt-4 text-lg">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nec odio dolor. Duis vitae
                neque vel orci congue
                feugiat. Aenean et eros in sapien eleifend elementum eu eget nisi. Vestibulum ante ipsum primis in faucibus orci
                luctus et ultrices posuere cubilia Curae; Nunc pulvinar ipsum vitae nunc vestibulum luctus. Ut tincidunt felis
                nec
                dui iaculis posuere.</p>
            <h2 class="mt-8 text-3xl font-semibold">Our Services</h2>
            <ul class="mt-4 text-lg">
                <li class="list-disc ml-8">Event Planning</li>
                <li class="list-disc ml-8">Venue Management</li>
                <li class="list-disc ml-8">Ticketing Solutions</li>
                <li class="list-disc ml-8">Registration & Check-in</li>
            </ul>
        </div>
    </div>
    
    <script src="{{ asset('js/data-replacer.js') }}"></script>
@endsection
