<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="https://cdn.tailwindcss.com"></script>
        @include('layouts.navbar')
    </head>
<body>
    <div class="text-center mt-4">
        <h1 class="text-4xl font-bold text-blue-900">Selamat Datang di Lokal Spot</h1>
        <p class="mt-2 text-lg text-gray-600 mb-10">Cari Spot ternyamanmu! </p>
        <x-text-input type="text" placeholder="Search for local spots..." class="w-1/2 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
    
    <div class="w-full h-auto p-10 bg-blue-900 rounded mt-10 flex flex-row justify-center gap-10">
        <img href="#" src="{{ asset('images/logo.jpeg') }}" alt="Cafe 1" class="w-20 h-auto object-cover rounded-lg mx-2" placeholder="nganu">
        <img href="#" src="{{ asset('images/logo.jpeg') }}" alt="Cafe 2" class="w-20 h-auto object-cover rounded-lg mx-2" placeholder="nganu">
        <img href="#" src="{{ asset('images/logo.jpeg') }}" alt="Cafe 3" class="w-20 h-auto object-cover rounded-lg mx-2" placeholder="nganu">
        <img href="#" src="{{ asset('images/logo.jpeg') }}" alt="Cafe 1" class="w-20 h-auto object-cover rounded-lg mx-2" placeholder="nganu">
        <img href="#" src="{{ asset('images/logo.jpeg') }}" alt="Cafe 2" class="w-20 h-auto object-cover rounded-lg mx-2" placeholder="nganu">
        <img href="#" src="{{ asset('images/logo.jpeg') }}" alt="Cafe 3" class="w-20 h-auto object-cover rounded-lg mx-2" placeholder="nganu">
        <img href="#" src="{{ asset('images/logo.jpeg') }}" alt="Cafe 3" class="w-20 h-auto object-cover rounded-lg mx-2" placeholder="nganu">
    </div>
    <div class="flex flex-col item-center justify-center">
        <h2 class="text-2xl font-bold text-black mt-10 mb-4">All Spot For You</h2>
        <div class="grid grid-cols-2 gap-6 mx-20 mb-10">
            <div class="bg-white rounded-lg shadow-md p-4">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Location 1" class="w-full h-40 object-cover rounded-lg mb-4">
                <h3 class="text-lg font-semibold text-gray-800 justify-end">Burjo Ngegas</h3>
                <span class="text-gray-600 justify-center">
                    Lorem ipsum dolor, sit amet consectetur 
                    adipisicing elit. Vel autem velit et commodi quod, 
                    dolorum cum asperiores dolores non similique mollitia harum 
                    odit, facilis distinctio praesentium, modi incidunt 
                    voluptate. Consequatur.
                </span>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Location 2" class="w-full h-40 object-cover rounded-lg mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Location 2</h3>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Location 3" class="w-full h-40 object-cover rounded-lg mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Location 3</h3>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Location 3" class="w-full h-40 object-cover rounded-lg mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Location 3</h3>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Location 3" class="w-full h-40 object-cover rounded-lg mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Location 3</h3>
            </div>
        </div>
    </div>
</body>
</html>