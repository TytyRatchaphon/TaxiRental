@extends('layouts.main')

@section('title', 'Create Event')

@section('content')
<div class="flex justify-center lh-10">
    <div class="bg-white shadow-lg rounded-lg max-w-5xl w-full p-10">
        <h1 class="text-2xl p-5">Create Event</h1>
        <hr>
        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col overflow-hidden mt-5">
                <div class="flex">
                    <div class="flex flex-col w-4/5 p-3">
                        <label for="event_name" class="pb-1">Event Title</label>
                        <input type="text" name="event_name" id="event_name" class="w-full">
                        @error('event_name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col w-1/5 p-3">
                        <label for="event_applicants_limit" class="pb-1">Applicants Limit</label>
                        <input type="number" name="event_applicants_limit" id="event_applicants_limit" class="w-full">
                        @error('event_applicants_limit')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-col w-full p-3">
                    <label for="event_location" class="pb-1">Location</label>
                    <input type="text" name="event_location" id="event_location" class="w-full">
                    @error('event_location')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col w-full p-3">
                    <label for="event_description" class="pb-1">Description</label>
                    <textarea name="event_description" id="event_description" class="w-full h-40"></textarea>
                    @error('event_description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col p-3">
                    <label for="event_certificate_image" class="pb-3">Add Event Certificate Image</label>
                    <input type="file" name="event_certificate_image" id="event_certificate_image" class="h-64 w-full hover:opacity-80 rounded-lg cursor-pointer border-yellow-200">
                    @error('event_certificate_image')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col  p-3">
                    <label for="event_thumbnail" class="pb-3">Add Event Thumbnail</label>
                    <input type="file" name="event_thumbnail" id="event_thumbnail" class="h-64 w-full hover:opacity-80 rounded-lg cursor-pointer border-yellow-200">
                    @error('event_thumbnail')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col  p-3">
                    <label for="event_image" class="pb-3">Add Images</label>
                    <input type="file" name="event_image" id="event_image" class="h-64 w-full hover:opacity-80 rounded-lg cursor-pointer border-yellow-200">
                    @error('event_image')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex mt-3 mb-5">
                    <div class="flex items-center w-1/2 pl-3">
                        <label for="event_date" class="pr-3">Event Day</label>
                        <input type="date" name="event_date" id="event_date">
                        @error('event_date')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="flex items-center w-1/2">
                        <label for="event_application_deadline" class="pr-3">Application Deadline</label>
                        <input type="date" name="event_application_deadline" id="event_application_deadline">
                        @error('event_application_deadline')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex">
                    <div class="flex flex-col w-1/2 p-3">
                        <label for="event_expense_amount" class="pb-1">Expense Amount</label>
                        <input type="number" name="event_expense_amount" id="event_expense_amount" class="w-full" min="0" step="0.01">
                        @error('event_expense_amount')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col w-1/2 p-3">
                        <label for="event_staffs_limit" class="pb-1">Staffs Limit</label>
                        <input type="number" name="event_staffs_limit" id="event_staffs_limit" class="w-full" min="1">
                        @error('event_staffs_limit')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex">
                    <div class="pl-3">
                        Please note that after event is created, you're request will be reviewed by operator soon.
                    </div>
                </div>
                <div class="flex mt-10">
                    <button type="submit" class="bg-[#F6D106] p-2 mr-5 rounded-lg w-32 hover:opacity-80">Create</button>
                    
                    <a href="{{ route('events.index') }}" class="bg-[#FF6666] p-2 rounded-lg w-24 hover:opacity-80">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
