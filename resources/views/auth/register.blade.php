<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
<body>
<div class="min-h-screen flex items-center justify-center bg-gradient-to-bl from-blue-900 via-blue-200 to-blue-800 px-4">
    <div class="bg-white p-8 m-8 rounded-2xl shadow-xl w-full max-w-md border border-orange-200">
        <!-- Title -->
        <h2 class="text-3xl font-bold text-center text-black-600 mb-4">
            Lokal Spot
        </h2>
        <h2 class="text-2xl font-bold text-blue-600 mb-3">
            Lets get Started
        </h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                    :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- No telp -->
            <div class="mt-4">
                <x-input-label for="no_telp" :value="__('No.Telp')" />
                <x-text-input id="no_telp" class="block mt-1 w-full" type="tel" name="no_telp"
                    :value="old('no_telp')" pattern="[0-9]+" inputmode="numeric" required autocomplete="tel" />
                <x-input-error :messages="$errors->get('no_telp')" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                    :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                    required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Buttons -->
            <div class="flex flex-col items-center mt-6">
                <x-primary-button>
                    {{ __('Create Account') }}
                </x-primary-button>

                <a class="underline text-sm text-gray-600 hover:text-orange-700"
                    href="{{ route('login') }}">
                    {{ __('Have an account? Login') }}
                </a>
            </div>
        </form>
    </div>
</body>
</html>
