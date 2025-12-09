@extends(Auth::check() ? 'layouts.navbar' : 'guest.layouts.app')

@section('title', 'About Us - LocalSpot')

@section('styles')
<style>
    .team-card {
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .team-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.15);
    }

    .feature-icon {
        transition: transform 0.3s;
    }

    .feature-card:hover .feature-icon {
        transform: scale(1.1);
    }
</style>
@endsection

@section('content')
<!-- Hero Section with Team Photo Background -->
<section class="min-h-[600px] flex items-center text-white px-8 py-16 relative bg-cover bg-center"
         style="background: linear-gradient(rgba(30, 58, 138, 0.85), rgba(59, 130, 246, 0.85)), url('{{ asset('images/team-photo.jpeg') }}') center/cover; background-size: cover;">
    <!-- Ganti 'team-photo.jpg' dengan nama file foto team Anda -->
    <div class="max-w-7xl mx-auto w-full">
        <div class="max-w-2xl">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 drop-shadow-lg">HELLO! WE ARE<br>TEAM ONE</h1>
            <p class="text-lg md:text-xl mb-8 leading-relaxed drop-shadow-lg">
                We are a passionate student team from SMKN 8 Semarang, dedicated to creating digital solutions that support local culinary businesses. Together, we combine creativity, technology, and collaboration to build Local Spot for the community.
            </p>
            <a href="mailto:localspot13@gmail.com"
               class="inline-flex items-center gap-3 bg-amber-500 hover:bg-amber-600 text-white font-bold px-8 py-4 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                </svg>
                Contact Us
            </a>
        </div>
    </div>
</section>

<!-- Vision Section -->
<section class="bg-gray-900 py-16 relative">
    <div class="max-w-6xl mx-auto px-8">
        <div class="flex flex-col md:flex-row items-start md:items-center gap-12">
            <div class="flex-shrink-0 md:w-1/3">
                <h2 class="text-4xl font-bold text-white mb-2">OUR VISION</h2>
                <div class="w-20 h-1 bg-amber-500"></div>
            </div>
            <div class="flex-1 md:w-2/3">
                <p class="text-xl text-gray-300 leading-relaxed">
                    To become the most trusted digital platform that connects communities with authentic local culinary experiences while empowering UMKN to grow through innovative technology solutions.
                </p>
            </div>
        </div>
    </div>
    <!-- Divider Line -->
    <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-gray-700 to-transparent"></div>
</section>

<!-- Why Choose Section (from image) -->
<section class="bg-gray-900 py-16">
    <div class="max-w-6xl mx-auto px-8">
        <h2 class="text-4xl font-bold text-center text-white mb-4">WHY CHOOSE LOCAL SPOT?</h2>
        <p class="text-center text-gray-400 mb-12 max-w-3xl mx-auto">
            We leverage cutting-edge digital platforms to connect communities with authentic local culinary experiences, while empowering UMKN to grow through visibility and authentic brand storytelling.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="feature-card bg-gray-800 rounded-2xl p-8 shadow-lg text-center border border-gray-700">
                <div class="feature-icon w-20 h-20 bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-blue-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-3">Trusted Always</h3>
                <p class="text-gray-400">
                    We curate and verify every culinary spot to ensure authentic and quality experiences for our community.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="feature-card bg-gray-800 rounded-2xl p-8 shadow-lg text-center border border-gray-700">
                <div class="feature-icon w-20 h-20 bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-blue-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-3">Elevating Recognition</h3>
                <p class="text-gray-400">
                    We spotlight hidden gems and help local UMKN gain the recognition they deserve in the digital space.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="feature-card bg-gray-800 rounded-2xl p-8 shadow-lg text-center border border-gray-700">
                <div class="feature-icon w-20 h-20 bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-blue-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-3">Impactful Support</h3>
                <p class="text-gray-400">
                    Our platform drives real growth for local businesses through increased visibility and community engagement.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Meet The Team Section -->
<section class="bg-white py-16">
    <div class="max-w-6xl mx-auto px-8">
        <h2 class="text-4xl font-bold text-center text-gray-900 mb-4">MEET THE TEAM</h2>
        <p class="text-center text-gray-600 mb-12">The creative minds behind Local Spot</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Team Member 1 -->
<div class="team-card bg-gradient-to-br from-blue-50 to-white rounded-2xl p-6 shadow-lg text-center border border-gray-100">
    <div class="w-24 h-24 rounded-full mx-auto mb-4 overflow-hidden shadow-lg">
        <img src="member/member1.jpeg" alt="Alvaro Dwi Oktaviano" class="w-full h-full object-cover">
    </div>
    <h3 class="text-xl font-bold text-gray-900 mb-2">Alden Fathin Hanif</h3>
    <p class="text-blue-600 font-semibold mb-3">Frontend Developer</p>
</div>

<!-- Team Member 2 -->
<div class="team-card bg-gradient-to-br from-purple-50 to-white rounded-2xl p-6 shadow-lg text-center border border-gray-100">
    <div class="w-24 h-24 rounded-full mx-auto mb-4 overflow-hidden shadow-lg">
        <img src="member/member2.jpeg" alt="Mochammad Naufal" class="w-full h-full object-cover">
    </div>
    <h3 class="text-xl font-bold text-gray-900 mb-2">Annisa Khurun'ain</h3>
    <p class="text-purple-600 font-semibold mb-3">UI/UX Designer</p>
</div>

<!-- Team Member 3 -->
<div class="team-card bg-gradient-to-br from-pink-50 to-white rounded-2xl p-6 shadow-lg text-center border border-gray-100">
    <div class="w-24 h-24 rounded-full mx-auto mb-4 overflow-hidden shadow-lg">
        <img src="member/member3.jpeg" alt="Qonita Farah" class="w-full h-full object-cover">
    </div>
    <h3 class="text-xl font-bold text-gray-900 mb-2">Defan Maulana Asyar</h3>
    <p class="text-pink-600 font-semibold mb-3">Frontend Developer</p>
</div>

<!-- Team Member 4 -->
<div class="team-card bg-gradient-to-br from-amber-50 to-white rounded-2xl p-6 shadow-lg text-center border border-gray-100">
    <div class="w-24 h-24 rounded-full mx-auto mb-4 overflow-hidden shadow-lg">
        <img src="member/member4.jpeg" alt="Refa Auliana" class="w-full h-full object-cover">
    </div>
    <h3 class="text-xl font-bold text-gray-900 mb-2">Krisna Aditya Saputra</h3>
    <p class="text-amber-600 font-semibold mb-3">Backend Developer</p>
</div>

<!-- Team Member 5 -->
<div class="team-card bg-gradient-to-br from-green-50 to-white rounded-2xl p-6 shadow-lg text-center border border-gray-100">
    <div class="w-24 h-24 rounded-full mx-auto mb-4 overflow-hidden shadow-lg">
        <img src="member/member5.jpeg" alt="Team Member 5" class="w-full h-full object-cover">
    </div>
    <h3 class="text-xl font-bold text-gray-900 mb-2">Martasyal Sylvia Dewi</h3>
    <p class="text-green-600 font-semibold mb-3">UI/UX Designer</p>
</div>

<!-- Team Member 6 -->
<div class="team-card bg-gradient-to-br from-indigo-50 to-white rounded-2xl p-6 shadow-lg text-center border border-gray-100">
    <div class="w-24 h-24 rounded-full mx-auto mb-4 overflow-hidden shadow-lg">
        <img src="member/member6.jpeg" alt="Team Member 6" class="w-full h-full object-cover">
    </div>
    <h3 class="text-xl font-bold text-gray-900 mb-2">Muhammad Rizqy Ramadham</h3>
    <p class="text-indigo-600 font-semibold mb-3">Backend Developer</p>
</div>

        </div>
    </div>
</section>
@endsection
