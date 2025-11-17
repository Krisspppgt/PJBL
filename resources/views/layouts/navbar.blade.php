<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
<body>
    <nav class="bg-blue-900 p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center ">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Lokal Spot Logo" class="w-10 h-10 rounded-full ">Lokal Spot
            <div class="text-white">    
                <a href="{{ route('homepage') }}" class="text-white hover:text-blue-600 mx-2">Home</a>
                <a href="#" class="mx-2 hover:text-blue-600">About</a>
                <a href="#" class="mx-2 hover:text-blue-600">Contact</a>
            </div>
        </div>
    </nav>
</body>
</html>