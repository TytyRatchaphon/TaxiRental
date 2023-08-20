@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'text-black border-gray-300 focus:border-[#F6D106] focus:ring-[#F6D106] rounded-md shadow-sm']) !!}>
