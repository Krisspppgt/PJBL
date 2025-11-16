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
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="block mt-1 w-full"
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

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
                    <x-primary-button class="ms-3 w-full text-center bg-blue-600 hover:bg-blue-700 justify-center">
                        {{ __('Log in') }}
                    </x-primary-button>
                    <div class="flex items-center pt-1">
                    <span class="text-sm text-gray-600 dark:text-gray-400">
                        Don't have an account?
                    </span>
                    <a href="{{ route('register') }}"
                        class="">
                        Sign up
                    </a>
                    </div>
                </div>

            </form>

        </div>

    </div>
</body>

</html>
