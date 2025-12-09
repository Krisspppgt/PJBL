<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Verify Email - Local Spot</title>
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
            VERIFY YOUR EMAIL
        </h2>
        <p class="text-center text-gray-600 mb-6">
            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                <p class="text-sm text-green-800 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    A new verification link has been sent to your email address!
                </p>
            </div>
        @endif

        <div class="space-y-4">
            <!-- Resend Verification Email -->
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-blue-700 text-white font-semibold py-3 rounded-lg hover:from-blue-600 hover:to-blue-800 transition-all duration-300 shadow-lg">
                    Resend Verification Email
                </button>
            </form>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full bg-white border-2 border-gray-300 text-gray-700 font-semibold py-3 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-300">
                    Log Out
                </button>
            </form>
        </div>
    </div>
</body>
</html>
