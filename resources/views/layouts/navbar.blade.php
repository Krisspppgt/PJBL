<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
<body>
    <nav class="bg-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-xl font-bold text-blue-600">Lokal Spot</a>
            <div>
                <a href="{{ route('homepage') }}" class="text-gray-700 hover:text-blue-600 mx-2">Home</a>
                <a href="#" class="text-gray-700 hover:text-blue-600 mx-2">About</a>
                <a href="#" class="text-gray-700 hover:text-blue-600 mx-2">Contact</a>
            </div>
        </div>
    </nav>
</body>
</html>