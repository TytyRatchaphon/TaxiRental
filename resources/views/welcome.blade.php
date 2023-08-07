@extends('layouts.main')

@section('title', 'Welcome')

@section('content')
    <header class="h-100 bg-gradient-to-r from-orange-900 to-yellow-700 text-white py-20 text-center bg-scroll">
        <h1 class="text-4xl md:text-5xl font-semibold">Welcome to Event Management</h1>
        <p class="mt-4 text-lg md:text-xl">Manage and organize your events with ease.</p>
        <a href="{{ url('/home') }}"
            class="transition-transform duration-500 hover:scale-110 mt-8 px-8 py-4 bg-yellow-500 text-white font-medium rounded-lg inline-block hover:bg-yellow-600 animate-bounce">Enter Stie
            </a>
    </header>

    <div class="my-2 flex flex-wrap items-center justify-between max-w-screen-xl mx-auto">
        <div class="container mt-8">
            <h2 class="font-extrabold text-transparent text-6xl bg-clip-text bg-gradient-to-r from-orange-400 to-yellow-200 text-center">About Honey Lemon Hub</h2>
            <h3 class="font-extrabold text-transparent text-4xl bg-clip-text bg-gradient-to-r from-orange-600 to-yellow-500 text-center">
                    Meet the best event organize platform.
            </h3>
            <p class="mt-4 text-lg text-center font-medium">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nec odio dolor. Duis vitae
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
    
@endsection
