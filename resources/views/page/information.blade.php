<html>
    @extends('layouts.app')
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body> 
        @section('content')
        <div class="bg-white">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Information Image" class="w-1/2 h-auto object-cover rounded-lg justify-center items-center object-center mx-auto mt-10">
            <h2 class="text-3xl font-bold text-black mt-4 ml-7 mb-4">Nama Tempat</h2>
            <div class ="flex flex-row ml-7 mb-4">
                <span class="text-yellow-400">&#9733;&#9733;&#9733;&#9733;&#9734;</span>
                <span class="text-gray-600 ml-2">(4.0)</span>
            </div>
            <div class ="flex flex-row ml-7 mr-10 mb-4 gap-2">
                <div href="#" class="w-full p-2 rounded bg-blue-800 items-center justify-center text-center text-white">
                    <a href ="#" class="font-bold">Direction</a>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-9">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-9">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                </svg>
            </div>
            <h2 class="font-bold text-2xl ml-7 mt-5">Description</h2>
            <p class="justify-center ml-7">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis veritatis autem aspernatur consequuntur nemo recusandae? 
                Non, pariatur, reprehenderit perspiciatis voluptates harum ullam quibusdam facere molestiae velit, voluptate ea temporibus ad!
            </p>
            <div class="flex flex-col gap-2 ml-10 w-1/4 mt-4 mb-5">
                <div class="border rounded-full p-5">
                    <p class="font-bold">Hours</p>
                    <p>09:00</p>
                </div>
                <div class="border rounded-full p-5">
                    <p class="font-bold">Instagram</p>
                    <p>@namatempat</p>
                </div>
            </div>
            <h2 class="text-2xl font-bold text-black mt-10 mb-4 ml-7">Reviews</h2>
            <div class="w-auto border border-black rounded m-5 flex flex-col p-4 gap-2">
                <div class="flex flex-col ml-2">
                    <div class="flex flex-row gap-1">
                        <div class="rounded-full border border-black p-2 w-fit"></div>
                        <span class="font-bold">user 1</span>
                    </div>
                    <div class="flex flex-col gap-2 mb-2">
                        <div class="flex flex-row gap-1">
                            <span class="text-yellow-400">&#9733;&#9733;&#9733;&#9733;&#9734;</span>
                            <span class="text-gray-600">(4.0)</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem explicabo nesciunt sit dolorum magni sed illo numquam, enim ut dicta! Dignissimos recusandae corporis ut cumque soluta fugit nam illum deleniti.</p>
                    </div>
                    <div class="flex flex-row gap-1">
                        <div class="rounded-full border border-black p-2 w-fit"></div>
                        <span class="font-bold">user 1</span>
                    </div>
                    <div class="flex flex-col gap-2 mb-2">
                        <div class="flex flex-row gap-1">
                            <span class="text-yellow-400">&#9733;&#9733;&#9733;&#9733;&#9734;</span>
                            <span class="text-gray-600">(4.0)</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem explicabo nesciunt sit dolorum magni sed illo numquam, enim ut dicta! Dignissimos recusandae corporis ut cumque soluta fugit nam illum deleniti.</p>
                    </div>
                </div>
            </div>  
            <a href="/comment" class="block w-fit mx-auto mb-10 px-6 py-3 bg-blue-800 text-white rounded-full font-semibold hover:bg-blue-900">Add Review</a>
        </div>
    </body>
    @endsection
</html>