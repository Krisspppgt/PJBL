<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Forgot Password - Local Spot</title>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-400 via-blue-300 to-blue-100 px-4">
    <div class="bg-white p-8 rounded-3xl shadow-2xl w-full max-w-md">
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <div class="w-24 h-24 bg-white rounded-full shadow-lg flex items-center justify-center">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Local Spot Logo" class="w-20 h-20 rounded-full">
            </div>
        </div>

        <!-- Title -->
        <h2 class="text-3xl font-bold text-center text-blue-600 mb-2">
            FORGOT PASSWORD?
        </h2>
        <p class="text-center text-gray-600 mb-6">No problem. Just let us know your email address and we will email you a password reset link.</p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                    </span>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Enter your email"
                    />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Send Reset Link Button -->
            <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-blue-700 text-white font-semibold py-3 rounded-lg hover:from-blue-600 hover:to-blue-800 transition-all duration-300 shadow-lg">
                Email Password Reset Link
            </button>

            <!-- Back to Login Link -->
            <div class="mt-4 text-center">
                <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:text-blue-800 font-semibold inline-flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Back to Login
                </a>
            </div>
        </form>
    </div>
</body>
</html>
