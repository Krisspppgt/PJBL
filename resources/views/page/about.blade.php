@extends('guest.layouts.app')

@section('title', 'About Us - LocalSpot')

@section('content')
<section class="bg-white">
    <section class="min-h-[450px] flex flex-col justify-center items-center text-white text-center p-8"
         style="background: linear-gradient(rgba(0,0,0,0.4), rgba(255, 255, 255, 0.4)), center/cover;"
         src="{{ ('images/logo.jpeg') }}">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">HELLO! We are team one </h1>
        <p class="text-lg md:text-xl max-w-3xl">We are a passionate student team from SMKN 8 Semarang, dedicated to creating digital solutions that support local culinary businesses. Together, we combine creativity, technology, and collaboration to build Local Spot for the community.</p>
        <button href="mailto:localspot13@gmail.com" class="rounded-full bg-amber-500 p-2 mt-3 font-bold text-black flex items-center gap-2 hover:bg-amber-600 transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
            </svg>
                contact us
        </button>
    </section>
    <div class="flex flex-row gap-10 ml-10 mx-auto mt-10 mb-10 max-w-6xl">
        <h1 class="font-bold text-xl">Our Vision</h1>
        <p class="">To be a leading platform in empowering local culinary businesses through innovative digital solutions, fostering community growth and cultural appreciation.</p>
    </div>
    <h1 class="font-bold text-xl text-center">Meet The Team</h1>
    <div class=""></div>
</section>
@endsection
