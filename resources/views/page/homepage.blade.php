<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="https://cdn.tailwindcss.com"></script>
        @include('layouts.navbar')
    </head>
<body>
    <div class="min-h-screen flex items-center justify-center bg-white">
        <img src="{{ asset('images/logo.jpeg') }}" alt="Homepage Image" class="max-w-full h-auto rounded-lg shadow-lg">
    </div>
</body>
</html>