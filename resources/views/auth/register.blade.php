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
           <!-- Password -->
<div class="mt-4 relative">
    <x-input-label for="password" :value="__('Password')" />

    <div class="relative">
        <x-text-input 
            id="password"
            class="block mt-1 w-full pr-10"
            type="password"
            name="password"
            required autocomplete="new-password"
        />

        <!-- Toggle Icon -->
        <button type="button"
            onclick="togglePassword('password', 'eyeOpen1', 'eyeClosed1')"
            class="absolute inset-y-0 right-3 flex items-center text-gray-500">

            <!-- Eye Open -->
            <svg id="eyeOpen1" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>

            <!-- Eye Closed -->
            <svg id="eyeClosed1" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 013.114-4.568M9.88 9.88a3 3 0 104.24 4.24" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3l18 18" />
            </svg>
        </button>
    </div>

    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>


<!-- Confirm Password -->
<div class="mt-4 relative">
    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

    <div class="relative">
        <x-text-input 
            id="password_confirmation"
            class="block mt-1 w-full pr-10"
            type="password"
            name="password_confirmation"
            required autocomplete="new-password"
        />

        <!-- Toggle Icon -->
        <button type="button"
            onclick="togglePassword('password_confirmation', 'eyeOpen2', 'eyeClosed2')"
            class="absolute inset-y-0 right-3 flex items-center text-gray-500 ">

            <!-- Eye Open -->
            <svg id="eyeOpen2" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>

            <!-- Eye Closed -->
            <svg id="eyeClosed2" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 013.114-4.568M9.88 9.88a3 3 0 104.24 4.24" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3l18 18" />
            </svg>
        </button>
    </div>

    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
</div>


<!-- Script -->
<script>
function togglePassword(inputId, eyeOpenId, eyeClosedId) {
    const input = document.getElementById(inputId);
    const eyeOpen = document.getElementById(eyeOpenId);
    const eyeClosed = document.getElementById(eyeClosedId);

    if (input.type === "password") {
        input.type = "text";
        eyeOpen.classList.add("hidden");
        eyeClosed.classList.remove("hidden");
    } else {
        input.type = "password";
        eyeOpen.classList.remove("hidden");
        eyeClosed.classList.add("hidden");
    }
}
</script>



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
