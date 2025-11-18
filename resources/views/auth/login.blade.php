<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>

<body>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-b from-blue-600 to-white px-4">

        <div class="bg-white p-8 m-8 rounded-2xl shadow-xl w-full max-w-md border border-orange-200">
            <h2 class="text-3xl font-bold text-center text-black-600 mb-4">
                Lokal Spot
            </h2>
            <h2 class="text-3xl font-bold text-center text-blue-600 mb-4">
                Welcome Back!
            </h2>
            <a class ="mb-2 font-bold text-black-400">Log in to continue</a>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input
                        id="email"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username"
                        class="block mt-1 w-full"
                        placeholder="masukkan email"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4 relative">
    <x-input-label for="password" :value="__('Password')" />

    <div class="relative">
        <x-text-input 
            id="password" 
            class="block mt-1 w-full pr-10" 
            type="password" 
            name="password"
            required 
            autocomplete="new-password"
            placeholder="masukkan password"
        />

        <!-- Icon Toggle -->
        <button type="button" 
            onclick="togglePassword()" 
            class="absolute inset-y-0 right-3 flex items-center text-gray-500">
            <!-- Mata default -->
            <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>

            <!-- Mata tertutup -->
            <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 013.114-4.568M9.88 9.88a3 3 0 104.24 4.24" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3l18 18" />
            </svg>
        </button>
    </div>

    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const eyeOpen = document.getElementById('eyeOpen');
        const eyeClosed = document.getElementById('eyeClosed');

        if (input.type === 'password') {
            input.type = 'text';
            eyeOpen.classList.add('hidden');
            eyeClosed.classList.remove('hidden');
        } else {
            input.type = 'password';
            eyeOpen.classList.remove('hidden');
            eyeClosed.classList.add('hidden');
        }
    }
</script>


                <!-- Remember Me -->
                <div class="block mt-4 flex flex-row items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center">
                        <input
                            id="remember_me"
                            type="checkbox"
                            name="remember"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm
                                   dark:bg-gray-900 dark:border-gray-700
                                   focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                        >
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">
                            Remember me
                        </span>
                    </label>
                    <div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="underline text-sm text-gray-600 hover:text-gray-900
                                   dark:text-gray-400 dark:hover:text-gray-100
                                   rounded-md focus:outline-none focus:ring-2
                                   focus:ring-offset-2 focus:ring-indigo-500
                                   dark:focus:ring-offset-gray-800">
                            Forgot Password
                        </a>
                    @endif
                </div>
                </div>

                <!-- Login + Forgot Password -->
                


                <!-- Signup Link -->
                <div class="mt-4 text-center w-full flex flex-col items-center justify-center">
                    <x-primary-button class="ms-3 text-center bg-blue-600 hover:bg-blue-700 justify-center px-6 py-1">
                        {{ __('Log in') }}
                    </x-primary-button>
                    <div class="flex items-center pt-1">
                    <span class="text-sm text-gray-600 dark:text-gray-400">
                        Don't have an account?
                    </span>
                    <a href="{{ route('register') }}"
                        class="text-blue-600 hover:text-blue-800 font-semibold ms-1">
                        Sign up
                    </a>
                    </div>
                </div>

            </form>

        </div>

    </div>
</body>
</html>
