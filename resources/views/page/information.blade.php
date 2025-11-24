<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="https://cdn.tailwindcss.com"></script>
        @include('layouts.navbar')
    </head>
    <body> 
        <div class="bg-white">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Information Image" class="w-1/2 h-auto object-cover rounded-lg justify-center items-center">
            <h2 class="text-3xl font-bold text-black mt-4 ml-7 mb-4">Nama Tempat</h2>
            <div class ="flex flex-row ml-7 mb-4">
                <span class="text-yellow-400">&#9733;&#9733;&#9733;&#9733;&#9734;</span>
                <span class="text-gray-600 ml-2">(4.0)</span>
            </div>
            <div class ="flex flex-row ml-7 mr-10 mb-4 gap-2">
                <div href="#" class="w-full p-2 rounded bg-blue-800 items-center justify-center text-center text-white">
                    <a href ="#" class="font-bold">Direction</a>
                </div>
                <div class="rounded w-fit h-auto border border-black flex">Like</div>
                <div class="rounded w-fit h-auto border border-black flex">Share</div>
            </div>
            <h2 class="font-bold ml-5">Description</h2>
            <p class="justify-center">


        </div>
    </body>
</html>