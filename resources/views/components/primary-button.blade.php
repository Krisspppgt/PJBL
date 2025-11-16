<button {{ $attributes->merge(['type' => 'submit', 'class' => 'ms-3 mb-3 rounded w-full text-center text-white bg-gradient-to-r from-blue-600 via-red-500 to-blue-900 hover:scale-95 transition duration-500 justify-center']) }}>
    {{ $slot }}
</button>
