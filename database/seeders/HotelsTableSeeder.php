<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\HotelCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class HotelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Clear old categories and pivot data so the tabs are perfectly clean
        \Illuminate\Support\Facades\DB::statement('PRAGMA foreign_keys=OFF;');
        \Illuminate\Support\Facades\DB::table('category_hotel')->truncate();
        \Illuminate\Support\Facades\DB::table('hotel_categories')->truncate();
        \Illuminate\Support\Facades\DB::table('hotels')->truncate();
        \Illuminate\Support\Facades\DB::statement('PRAGMA foreign_keys=ON;');

        // 2. Define and create the new Country Categories
        $categoryNames = [
            'All Hotels', 'India', 'Bali', 'Sri Lanka', 'Malaysia', 
            'Nepal', 'Thailand', 'Indonesia', 'Bhutan'
        ];
        
        $categoryMap = [];
        foreach ($categoryNames as $name) {
            $categoryMap[$name] = HotelCategory::create([
                'slug' => Str::slug($name),
                'name' => $name
            ]);
        }

        // 2. Define the Hotel Data (All currently fall under India)
        $explicitHotels = [
            'Summit Barsana Resort & Spa' => [
                'rating' => 4,
                'location' => 'Kalimpong',
                'description' => 'Summit Barsana Resort & Spa, Kalimpong is a serene hillside retreat offering comfortable accommodations with beautiful Himalayan views. Surrounded by lush greenery, the resort features well-appointed rooms, a multi-cuisine restaurant, a rejuvenating spa, and modern amenities, making it an ideal choice for couples, families, and leisure travelers seeking a peaceful stay in Kalimpong.',
            ],
            'Hotel priority' => [
                'rating' => 3,
                'location' => 'Guwahati',
                'description' => 'Hotel Priority, Guwahati is a comfortable and conveniently located hotel offering a pleasant stay for both business and leisure travelers. Featuring well-appointed rooms, modern amenities, and warm hospitality, the hotel provides easy access to Guwahati Railway Station, popular attractions, shopping areas, and the city\'s major landmarks.',
            ],
            'Hotel Nirvana Grand' => [
                'rating' => 3,
                'location' => 'Jodhpur',
                'description' => 'Hotel Nirvana Grand, Jodhpur- welcomes you with warm hospitality, elegant comforts, and a peaceful ambiance, making every stay truly memorable. Thoughtfully designed rooms, modern facilities, and attentive service create the perfect retreat after a day of exploring Jodhpur\'s magnificent forts, royal palaces, and colorful markets. Experience the charm of the Blue City while enjoying a relaxing and delightful stay.',
            ],
            'Woodberry Hotel & Spa' => [
                'rating' => 4,
                'location' => 'Gangtok',
                'description' => 'Woodberry Hotel & Spa offers a perfect blend of comfort, elegance, and warm hospitality. Featuring well-appointed rooms, modern amenities, a relaxing spa, and a delightful dining experience, the hotel provides a peaceful retreat for both leisure and business travelers, ensuring a comfortable and memorable stay.',
            ],
            'The Soma Hotel' => [
                'rating' => 3,
                'location' => 'Darjeeling',
                'description' => 'The Soma Hotel Darjeeling is a modern boutique hotel conveniently located near Mall Road and the town\'s major attractions. Offering well-appointed rooms with contemporary amenities, the hotel ensures a comfortable and relaxing stay for both families and couples. Guests can enjoy delicious multi-cuisine dining, warm hospitality, and, from select rooms, stunning views of the majestic Kanchenjunga. With its excellent location and quality service, The Soma Hotel is an ideal choice for a memorable stay in the Queen of the Hills.',
            ],
            'La Nicholas Dei Da Kine Resort' => [
                'rating' => 4,
                'location' => 'Shillong',
                'description' => 'La Nicholas - Lake View (by Summit Hotels) is a premier 4-star resort located near the tranquil waters of Umiam Lake in Shillong, Meghalaya. Positioned away from the busy commercial center of Shillong, this property balances natural hilltop vistas with premium hospitality.',
            ],
            'Lee Heritage' => [
                'rating' => 3,
                'location' => 'Srinagar',
                'description' => 'Lee Heritage, Srinagar is a comfortable hotel offering a warm and relaxing stay in the heart of Srinagar. With well furnished rooms, modern amenities, and friendly hospitality, it serves as an ideal base for exploring the city\'s iconic attractions, including Dal Lake, Mughal Gardens, and local markets.',
            ],
            'Le Coxy Resort' => [
                'rating' => 4,
                'location' => 'Lachung, Sikkim',
                'description' => 'Le Coxy Resort Lachung is one of the most popular accommodation options in Lachung, offering a comfortable stay amidst the breathtaking Himalayan landscapes of North Sikkim. Conveniently located at Fakha Chowk in the heart of Lachung village, the resort provides easy access to popular attractions such as Yumthang Valley, Zero Point, and Mt. Katao, making it an ideal base for travelers exploring the region.',
            ],
            'The Comfort Inn By STH Hotels' => [
                'rating' => 3,
                'location' => 'Shimla',
                'description' => 'The Comfort Inn by STH Hotels offers a warm and inviting stay where comfort meets genuine hospitality. Featuring cozy, well-appointed rooms, modern amenities, and attentive service, the hotel provides a relaxing retreat for every traveler. Whether you\'re visiting for business or leisure, enjoy a pleasant and memorable stay in a welcoming atmosphere.',
            ],
            'Summit by the Ganges Beach Resort & Spa' => [
                'rating' => 4,
                'location' => 'Rishikesh',
                'description' => 'Summit By The Ganges Beach Resort & Spa, Rishikesh is a serene riverside retreat nestled along the banks of the sacred Ganges. Surrounded by nature, the resort offers elegant accommodations, modern comforts, a rejuvenating spa, and warm hospitality. It\'s the perfect destination to unwind, soak in the peaceful atmosphere, and experience the spiritual charm of Rishikesh.',
            ],
            'Summit Calangute Resort & Spa' => [
                'rating' => 4,
                'location' => 'Goa',
                'description' => 'Summit Calangute Resort & Spa offers a perfect blend of comfort, style, and Goan hospitality in the heart of North Goa. Featuring elegant rooms, modern amenities, a refreshing swimming pool, a rejuvenating spa, and delightful dining options, the resort is an ideal retreat for a relaxing beach holiday, just moments away from the vibrant Calangute Beach.',
            ]
        ];

        // 3. Read from properties folder and create hotels
        $propertiesPath = public_path('images/properties');
        $files = \File::exists($propertiesPath) ? \File::files($propertiesPath) : [];

        foreach ($files as $file) {
            $filename = $file->getFilename();
            $hotelName = pathinfo($filename, PATHINFO_FILENAME);

            $hotelData = $explicitHotels[$hotelName] ?? [
                'rating' => 4,
                'location' => 'Various', // Default location if not known
                'description' => "Experience a wonderful stay at $hotelName, offering exceptional hospitality and modern comforts. An ideal choice for families and couples seeking a relaxing getaway.",
            ];

            $hotelData['name'] = $hotelName;
            $hotelData['country'] = 'India';
            $hotelData['image_path'] = 'images/properties/' . $filename;
            
            // Create or update the hotel
            $hotel = Hotel::updateOrCreate(
                ['name' => $hotelData['name']],
                $hotelData
            );
            
            // Sync the relationship via the pivot table `category_hotel`
            $categoriesToAttach = [];
            
            if (isset($categoryMap['All Hotels'])) {
                $categoriesToAttach[] = $categoryMap['All Hotels']->id;
            }
            if (isset($categoryMap['India'])) {
                $categoriesToAttach[] = $categoryMap['India']->id;
            }
            
            $hotel->categories()->syncWithoutDetaching($categoriesToAttach);
        }
    }
}
