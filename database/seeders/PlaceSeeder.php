<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Place;
use App\Models\User;

class PlaceSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first(); // Pastikan ada user

        $places = [
            [
                'name' => 'Kopi Kenangan',
                'category' => 'cafe',
                'description' => 'Kedai kopi modern dengan berbagai pilihan minuman kopi specialty dan makanan ringan. Suasana nyaman untuk bekerja atau nongkrong.',
                'address' => 'Jl. Hayam Wuruk No. 123, Pekalongan',
                'rating' => 4.8,
                'reviews_count' => 127,
                'tags' => 'Wifi,AC,Cozy,Parking',
                'phone' => '0285-1234567',
                'price_range' => 'Rp 15.000 - Rp 50.000',
            ],
            [
                'name' => 'Warung Soto Pak Min',
                'category' => 'street-food',
                'description' => 'Soto khas Pekalongan dengan kuah gurih dan daging empuk. Menu favorit warga lokal sejak 1985.',
                'address' => 'Jl. Dr. Sutomo No. 45, Pekalongan',
                'rating' => 4.9,
                'reviews_count' => 234,
                'tags' => 'Halal,Parking,Traditional',
                'phone' => '0285-7654321',
                'price_range' => 'Rp 10.000 - Rp 25.000',
            ],
            [
                'name' => 'Restoran Seafood Bahari',
                'category' => 'restaurant',
                'description' => 'Restaurant seafood dengan pemandangan pantai. Menu andalan: kepiting saus padang, ikan bakar, dan cumi goreng tepung.',
                'address' => 'Jl. Yos Sudarso No. 89, Pekalongan',
                'rating' => 4.7,
                'reviews_count' => 189,
                'tags' => 'Seafood,View,AC,Parking',
                'phone' => '0285-9876543',
                'price_range' => 'Rp 50.000 - Rp 150.000',
            ],
            [
                'name' => 'Bakery Manis Jaya',
                'category' => 'bakery',
                'description' => 'Toko roti dengan aneka kue dan pastry fresh daily. Speciality: roti tawar, croissant, dan birthday cake custom.',
                'address' => 'Jl. Gajah Mada No. 56, Pekalongan',
                'rating' => 4.6,
                'reviews_count' => 95,
                'tags' => 'Fresh,Halal,Custom Order',
                'phone' => '0285-3456789',
                'price_range' => 'Rp 5.000 - Rp 200.000',
            ],
            [
                'name' => 'Juice Corner Sehat',
                'category' => 'drink-area',
                'description' => 'Stand minuman segar dengan berbagai pilihan jus buah, smoothies, dan minuman herbal. Tanpa pengawet.',
                'address' => 'Jl. Ahmad Yani No. 34, Pekalongan',
                'rating' => 4.5,
                'reviews_count' => 78,
                'tags' => 'Fresh,Healthy,No Sugar',
                'phone' => '0285-2345678',
                'price_range' => 'Rp 8.000 - Rp 30.000',
            ],
            [
                'name' => 'Catering Nusantara',
                'category' => 'catering',
                'description' => 'Layanan catering untuk acara pernikahan, ulang tahun, dan meeting. Paket mulai dari 50 porsi.',
                'address' => 'Jl. Diponegoro No. 78, Pekalongan',
                'rating' => 4.8,
                'reviews_count' => 156,
                'tags' => 'Event,Wedding,Corporate',
                'phone' => '0285-8765432',
                'price_range' => 'Rp 25.000 - Rp 100.000 per porsi',
            ],
        ];

        foreach ($places as $place) {
            Place::create(array_merge($place, [
                'user_id' => $user->id,
                'latitude' => -6.888619 + (rand(-100, 100) / 10000),
                'longitude' => 109.675926 + (rand(-100, 100) / 10000),
            ]));
        }
    }
}
