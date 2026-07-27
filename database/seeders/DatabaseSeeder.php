<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\SiteSetting;
use App\Models\HeroSection;
use App\Models\WelcomeSection;
use App\Models\AboutSection;
use App\Models\Destination;
use App\Models\HotelCategory;
use App\Models\Hotel;
use App\Models\Testimonial;
use App\Models\Benefit;
use App\Models\Award;
use App\Models\Stat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Default Admin User
        if (!User::where('email', 'admin@happymilesdreamhospitality.com')->exists()) {
            User::create([
                'name' => 'Happy Miles Administrator',
                'email' => 'admin@happymilesdreamhospitality.com',
                'password' => Hash::make('adminpassword'),
            ]);
        }

        // 2. Seed Site Settings
        if (SiteSetting::count() === 0) {
            SiteSetting::create([
                'site_name' => 'Happy Miles',
                'contact_email' => 'info@happymilesdreamhospitality.com',
                'contact_phone' => '+91 8910364270',
                'contact_address' => 'AVS House, 42/1A Gurupada Halder Road. Kolkata - 700026',
                'working_hours' => 'Mon - Sat: 11:00 AM - 7:00 PM',
                'facebook_url' => '#',
                'instagram_url' => '#',
                'youtube_url' => '#',
                'logo_path' => 'images/Premium.png',
                'footer_logo_path' => 'images/Premium.png',
                'footer_blurb' => 'Division of The Happy Miles Tourism. Luxury resorts across the Caribbean, the Canary Islands, and Spain.',
            ]);
        }

        // 3. Seed Hero Section
        if (HeroSection::count() === 0) {
            HeroSection::create([
                'eyebrow' => 'Signature Travel Experience',
                'title' => 'Discover the Art of Resort Living',
                'subtitle' => 'Resort Life Awaits',
                'video_path' => 'images/video.mp4',
                'image_fallback_path' => 'images/HomeVideoBG.jpg',
            ]);
        }

        // 4. Seed Welcome Section
        if (WelcomeSection::count() === 0) {
            WelcomeSection::create([
                'tagline' => 'Happy Miles',
                'title' => 'Dream Hospitality',
                'description1' => 'Happy Miles Dream Hospitality is more than just a tour & travel company—we create experiences that go beyond ordinary journeys. We turn your dream vacations into reality with the perfect blend of comfort, luxury, and relaxation, ensuring every moment is truly special.',
                'description2' => 'From customized tours and dream holidays to personal events, day outings, candle light dinners, wellness services, and personal grooming—we offer complete hospitality solutions under one roof. Our focus is on delivering personalized, high-quality services that match your expectations and lifestyle.',
                'accent_text' => 'Where every miles begins with a hapy smile!',
                'image1_path' => 'images/WelcomeImg-1.jpg',
                'image2_path' => 'images/WelcomeImg-2.jpg',
                'image3_path' => 'images/WelcomeImg-3.jpg',
                'image4_path' => 'images/WelcomeImg-4.jpg',
            ]);
        }

        // 5. Seed About Section
        if (AboutSection::count() === 0) {
            AboutSection::create([
                'title' => 'Happy Miles',
                'subtitle' => 'ABOUT US',
                'description1' => 'Happy Miles offers a selection of 8 destinations and 19 hotels where you can enjoy exceptional seafront locations. Our hotels offer up-to-date facilities, carefully selected cuisine and services designed to cater to your every need.',
                'description2' => 'Since 2007, we’ve been working to guarantee the highest quality standards. Around 16,000 members are already enjoying all the benefits of our vacation program.',
                'description3' => 'At Happy Miles, we always have our clients in mind and are focused on making their vacation the best that it can be.',
                
                'amenities_title' => 'Privilege amenities',
                'amenities_description' => 'We offer our members rooms with Privilege amenities equipped with everything you will need for a relaxing and unforgettable holiday such as a fully stocked mini bar, room service, bath robes and slippers for your stay, butler service and much more.',
                'amenities_image_path' => 'images/About-1.jpg',
                
                'offers_title' => 'Special Offers',
                'offers_description' => 'Who doesn’t like an extra discount? We want you to get the best deal so make sure to login and check out all the active promotions available at our affiliated resorts and start planning your next getaway!',
                'offers_image_path' => 'images/About-2.jpg',
                
                'about_image1_path' => 'images/WelcomeImg-1.jpg',
                'about_image2_path' => 'images/WelcomeImg-2.jpg',
            ]);
        }

        // 6. Seed Destinations
        $destinations = [
            [
                'name' => 'Kashmir', 
                'image_path' => 'images/H-Kashmir.jpg', 
                'description' => 'Experience the paradise on earth. Nestled in the Himalayan mountains, Kashmir offers breathtaking snow-capped peaks, serene dal lake shikara rides, and beautiful alpine meadows to refresh your spirit.',
                'sort_order' => 1
            ],
            [
                'name' => 'Arunachal', 
                'image_path' => 'images/H-Arunachal.jpg', 
                'description' => 'Discover the land of the rising sun. Arunachal Pradesh is a majestic, untouched wilderness filled with ancient monasteries, high-altitude lakes, misty forests, and diverse tribal cultural heritage.',
                'sort_order' => 2
            ],
            [
                'name' => 'Kerala', 
                'image_path' => 'images/H-Kerala.jpg', 
                'description' => 'Explore God\'s own country. Rest in luxury along peaceful backwaters in traditional houseboats, walk through lush green tea plantations, and revitalize your body with ancient ayurvedic wellness treatments.',
                'sort_order' => 3
            ],
            [
                'name' => 'Goa', 
                'image_path' => 'images/H-Goa.jpg', 
                'description' => 'Relax on pristine golden beaches. Enjoy the vibrant coastal lifestyle, historic Portuguese architectural heritage, world-class seafront dining, and breathtaking sunset cruise tours across the Arabian Sea.',
                'sort_order' => 4
            ],
        ];
        foreach ($destinations as $d) {
            if (!Destination::where('name', $d['name'])->exists()) {
                Destination::create($d);
            }
        }

        // 7. Seed Hotel Categories
        $cats = [
            ['name' => 'All Hotels', 'slug' => 'all'],
            ['name' => 'Adults Only', 'slug' => 'adults'],
            ['name' => 'Despacio Spa Center', 'slug' => 'spa'],
            ['name' => 'Wedding', 'slug' => 'wedding'],
        ];
        $categoryModels = [];
        foreach ($cats as $c) {
            if (!HotelCategory::where('slug', $c['slug'])->exists()) {
                $categoryModels[$c['slug']] = HotelCategory::create($c);
            } else {
                $categoryModels[$c['slug']] = HotelCategory::where('slug', $c['slug'])->first();
            }
        }

        // 8. Seed Hotels and Associate with Categories
        // Tab-filtered hotels (from home page JS)
        $tabHotels = [
            [
                'name' => 'Ocean Eden Bay', 'rating' => 5, 'location' => 'Montego Bay | Jamaica', 'country' => 'Jamaica',
                'description' => 'Beachfront luxury with curated dining and family-friendly pools.', 'image_path' => 'images/profile1.jpg',
                'categories' => ['all', 'wedding']
            ],
            [
                'name' => 'Ocean Coral & Turquesa', 'rating' => 5, 'location' => 'Riviera Maya | Mexico', 'country' => 'Mexico',
                'description' => 'Spacious suites, vibrant experiences nearby, and endless ocean views.', 'image_path' => 'images/profile2.jpg',
                'categories' => ['all']
            ],
            [
                'name' => 'Ocean Maya Royale', 'rating' => 5, 'location' => 'Playa del Carmen | Mexico', 'country' => 'Mexico',
                'description' => 'Refined atmosphere with quiet pools and attentive concierge service.', 'image_path' => 'images/profile3.jpg',
                'categories' => ['all']
            ],
            [
                'name' => 'Azure Cove Retreat', 'rating' => 5, 'location' => 'Punta Cana | Dominican Republic', 'country' => 'Dominican Republic',
                'description' => 'Adults-only serenity, rooftop lounges, and spa rituals at sunset.', 'image_path' => 'images/profile2.jpg',
                'categories' => ['adults']
            ],
            [
                'name' => 'Velvet Shore', 'rating' => 4, 'location' => 'Tenerife | Spain', 'country' => 'Spain',
                'description' => 'Cliffside suites, infinity pools, and curated wine evenings.', 'image_path' => 'images/profile3.jpg',
                'categories' => ['adults']
            ],
            [
                'name' => 'Luna Bay Club', 'rating' => 5, 'location' => 'Montego Bay | Jamaica', 'country' => 'Jamaica',
                'description' => 'Quiet beaches, private cabanas, and chef-led tasting menus.', 'image_path' => 'images/profile1.jpg',
                'categories' => ['adults']
            ],
            [
                'name' => 'Despacio Spa Haven', 'rating' => 5, 'location' => 'Riviera Maya | Mexico', 'country' => 'Mexico',
                'description' => 'Thermal circuits, hydrotherapy, and bespoke wellness journeys.', 'image_path' => 'images/profile3.jpg',
                'categories' => ['spa']
            ],
            [
                'name' => 'Garden Springs', 'rating' => 5, 'location' => 'Gran Canaria | Spain', 'country' => 'Spain',
                'description' => 'Outdoor treatment suites nestled in tropical gardens.', 'image_path' => 'images/profile1.jpg',
                'categories' => ['spa']
            ],
            [
                'name' => 'Tide & Stone Spa', 'rating' => 4, 'location' => 'Punta Cana | Dominican Republic', 'country' => 'Dominican Republic',
                'description' => 'Mindful movement studios and marine-inspired therapies.', 'image_path' => 'images/profile2.jpg',
                'categories' => ['spa']
            ],
            [
                'name' => 'Ceremony Bay Resort', 'rating' => 5, 'location' => 'Montego Bay | Jamaica', 'country' => 'Jamaica',
                'description' => 'Oceanfront vows, ballroom receptions, and dedicated planners.', 'image_path' => 'images/profile1.jpg',
                'categories' => ['wedding']
            ],
            [
                'name' => 'Palm Court Estates', 'rating' => 5, 'location' => 'Riviera Maya | Mexico', 'country' => 'Mexico',
                'description' => 'Garden gazebos, live music terraces, and guest room blocks.', 'image_path' => 'images/profile2.jpg',
                'categories' => ['wedding']
            ],
            [
                'name' => 'Sunset Pier Hotel', 'rating' => 5, 'location' => 'Tenerife | Spain', 'country' => 'Spain',
                'description' => 'Cliff-top chapels and sunset photo sessions over the Atlantic.', 'image_path' => 'images/profile3.jpg',
                'categories' => ['wedding']
            ],
        ];

        // Specific properties page hotels (from our-hotels.html)
        $propHotels = [
            [
                'name' => 'Summit Barsana Resort & Spa', 'rating' => 4, 'location' => 'Kalimpong', 'country' => 'India',
                'description' => 'Summit Barsana Resort & Spa, Kalimpong is a serene hillside retreat offering comfortable accommodations with beautiful Himalayan views. Surrounded by lush greenery, the resort features well-appointed rooms, a multi-cuisine restaurant, a rejuvenating spa, and modern amenities, making it an ideal choice for couples, families, and leisure travelers seeking a peaceful stay in Kalimpong.', 'image_path' => 'images/profile.jpg',
                'categories' => ['all']
            ],
            [
                'name' => 'Hotel priority', 'rating' => 3, 'location' => 'Guwahati', 'country' => 'India',
                'description' => 'Hotel Priority, Guwahati is a comfortable and conveniently located hotel offering a pleasant stay for both business and leisure travelers. Featuring well-appointed rooms, modern amenities, and warm hospitality, the hotel provides easy access to Guwahati Railway Station, popular attractions, shopping areas, and the city\'s major landmarks.', 'image_path' => 'images/profile.jpg',
                'categories' => ['all']
            ],
            [
                'name' => 'Woodberry Hotel & Spa', 'rating' => 4, 'location' => 'Gangtok', 'country' => 'India',
                'description' => 'Woodberry Hotel & Spa offers a perfect blend of comfort, elegance, and warm hospitality. Featuring well-appointed rooms, modern amenities, a relaxing spa, and a delightful dining experience, the hotel provides a peaceful retreat for both leisure and business travelers, ensuring a comfortable and memorable stay.', 'image_path' => 'images/profile.jpg',
                'categories' => ['all']
            ],
            [
                'name' => 'The Comfort Inn By STH Hotels', 'rating' => 3, 'location' => 'Shimla', 'country' => 'India',
                'description' => 'The Comfort Inn by STH Hotels offers a warm and inviting stay where comfort meets genuine hospitality. Featuring cozy, well-appointed rooms, modern amenities, and attentive service, the hotel provides a relaxing retreat for every traveler. Whether you\'re visiting for business or leisure, enjoy a pleasant and memorable stay in a welcoming atmosphere.', 'image_path' => 'images/profile.jpg',
                'categories' => ['all']
            ],
            [
                'name' => 'The Soma Hotel', 'rating' => 3, 'location' => 'Darjeeling', 'country' => 'India',
                'description' => 'The Soma Hotel Darjeeling is a modern boutique hotel conveniently located near Mall Road and the town\'s major attractions. Offering well-appointed rooms with contemporary amenities, the hotel ensures a comfortable and relaxing stay for both families and couples. Guests can enjoy delicious multi-cuisine dining, warm hospitality, and, from select rooms, stunning views of the majestic Kanchenjunga. With its excellent location and quality service, The Soma Hotel is an ideal choice for a memorable stay in the Queen of the Hills.', 'image_path' => 'images/profile.jpg',
                'categories' => ['all']
            ],
            [
                'name' => 'La Nicholas Dei Da Kine Resort', 'rating' => 4, 'location' => 'Shillong', 'country' => 'India',
                'description' => 'La Nicholas - Lake View (by Summit Hotels) is a premier 4-star resort located near the tranquil waters of Umiam Lake in Shillong, Meghalaya. Positioned away from the busy commercial center of Shillong, this property balances natural hilltop vistas with premium hospitality.', 'image_path' => 'images/profile.jpg',
                'categories' => ['all']
            ]
        ];

        // Seed all hotels
        $allHotels = array_merge($tabHotels, $propHotels);

        foreach ($allHotels as $hData) {
            $categories = $hData['categories'];
            unset($hData['categories']);
            
            $h = Hotel::where('name', $hData['name'])->first();
            if (!$h) {
                $h = Hotel::create($hData);
            } else {
                $h->update($hData);
            }
            
            // Attach/Sync categories
            $catIds = [];
            foreach ($categories as $catSlug) {
                if (isset($categoryModels[$catSlug])) {
                    $catIds[] = $categoryModels[$catSlug]->id;
                }
            }
            $h->categories()->sync($catIds);
        }

        // 9. Seed Testimonials
        $testimonials = [
            // Home Slide Testimonials
            [
                'quote' => '“A very professional and experienced team. Well-mannered service. My Kerala tour was well managed. Mr. Arunava Roy is truly a gentleman.”',
                'author' => 'Debjit Chatterjee',
                'role' => 'Members since 2022',
                'avatar_path' => 'images/testimonial-01.jpg',
                'type' => 'home',
                'sort_order' => 1
            ],
            [
                'quote' => '“I traveled to Darjeeling & Kalimpong with Dream Hospitality. The arrangements were very good. My daughter enjoyed a lot. Thank you Mr. Arunava Roy.”',
                'author' => 'Prithviraj Dasgupta',
                'role' => 'Members since 2023',
                'avatar_path' => 'images/testimonial-02.jpg',
                'type' => 'home',
                'sort_order' => 2
            ],
            [
                'quote' => '“Very trustworthy and highly recommended. My Kashmir tour was well managed and properly coordinated. Mrs. Reshmi Biswas kept all her promises.”',
                'author' => 'Ashish Mishra',
                'role' => 'Member since 2020',
                'avatar_path' => 'images/testimonial-03.jpg',
                'type' => 'home',
                'sort_order' => 3
            ],
            // About Slide Testimonials
            [
                'quote' => 'Our favourite hotel is the Ocean El Faro...',
                'author' => 'Guest review',
                'role' => 'Member',
                'avatar_path' => 'images/Testimonio1.jpg',
                'type' => 'about',
                'sort_order' => 1
            ],
            [
                'quote' => 'All the staff at Ocean El Faro treats us very well...',
                'author' => 'Guest review',
                'role' => 'Member',
                'avatar_path' => 'images/Testimonio2.jpg',
                'type' => 'about',
                'sort_order' => 2
            ],
            [
                'quote' => 'We joined the Premium family in 2021...',
                'author' => 'Guest review',
                'role' => 'Member',
                'avatar_path' => 'images/Testimonio4.jpg',
                'type' => 'about',
                'sort_order' => 3
            ],
            [
                'quote' => 'We have been members for 10 years...',
                'author' => 'Guest review',
                'role' => 'Member',
                'avatar_path' => 'images/Testimonio5.jpg',
                'type' => 'about',
                'sort_order' => 4
            ]
        ];
        foreach ($testimonials as $t) {
            if (!Testimonial::where('quote', $t['quote'])->exists()) {
                Testimonial::create($t);
            }
        }

        // 10. Seed Benefits
        $benefits = [
            [
                'title' => 'Variety',
                'description' => 'You\'re not tied to the same destination every year...',
                'icon_path' => 'images/map-marked-blue.svg',
                'sort_order' => 1
            ],
            [
                'title' => 'Flexibility',
                'description' => 'Choose when and where you want to go...',
                'icon_path' => 'images/calendar-blue.svg',
                'sort_order' => 2
            ],
            [
                'title' => 'Automatic Subscription to RCI',
                'description' => 'Enjoy more than 4,300 affiliate hotels in over 100 countries...',
                'icon_path' => 'images/RCI-blue-new.svg',
                'sort_order' => 3
            ],
            [
                'title' => 'Best Price',
                'description' => 'We guarantee the best market rate for our affiliated hotels...',
                'icon_path' => 'images/dollar-sign-blue.svg',
                'sort_order' => 4
            ],
            [
                'title' => 'Club H10 Grand Class',
                'description' => 'Exclusive benefits in more than 66 hotels worldwide...',
                'icon_path' => 'images/clubh10-blue.svg',
                'sort_order' => 5
            ],
            [
                'title' => 'Customer Service',
                'description' => 'Our team is always on hand to help plan your vacation...',
                'icon_path' => 'images/headphones-blue.svg',
                'sort_order' => 6
            ]
        ];
        foreach ($benefits as $b) {
            if (!Benefit::where('title', $b['title'])->exists()) {
                Benefit::create($b);
            }
        }

        // 11. Seed Awards
        $awards = [
            [
                'title' => 'Best Travel Experience 2025',
                'description' => 'Recognized for delivering exceptional curated travel journeys.',
                'icon_class' => 'fas fa-trophy',
                'sort_order' => 1
            ],
            [
                'title' => 'Global Hospitality Excellence',
                'description' => 'Awarded for outstanding global service and customer satisfaction.',
                'icon_class' => 'fas fa-globe',
                'sort_order' => 2
            ],
            [
                'title' => '5-Star Client Satisfaction',
                'description' => 'Consistently rated top-tier by travelers worldwide.',
                'icon_class' => 'fas fa-star',
                'sort_order' => 3
            ],
            [
                'title' => 'Luxury Travel Innovator',
                'description' => 'Leading innovation in premium travel experiences.',
                'icon_class' => 'fas fa-plane-departure',
                'sort_order' => 4
            ],
            [
                'title' => 'Top Emerging Brand',
                'description' => 'Recognized as a fast-growing hospitality brand.',
                'icon_class' => 'fas fa-medal',
                'sort_order' => 5
            ],
            [
                'title' => 'Trusted Travel Partner',
                'description' => 'Building long-term relationships with global clients.',
                'icon_class' => 'fas fa-handshake',
                'sort_order' => 6
            ]
        ];
        foreach ($awards as $a) {
            if (!Award::where('title', $a['title'])->exists()) {
                Award::create($a);
            }
        }

        // 12. Seed Stats
        $stats = [
            ['value' => '5K+', 'label' => 'Happy Travelers', 'sort_order' => 1],
            ['value' => '42+', 'label' => 'Global Destinations', 'sort_order' => 2],
            ['value' => '10+', 'label' => 'Awards Won', 'sort_order' => 3],
            ['value' => '4.7★', 'label' => 'Average Rating', 'sort_order' => 4],
        ];
        foreach ($stats as $s) {
            if (!Stat::where('label', $s['label'])->exists()) {
                Stat::create($s);
            }
        }

        // 13. Seed Default Member
        if (!\App\Models\Member::where('customer_id', 'PTC-1001')->exists()) {
            \App\Models\Member::create([
                'customer_id' => 'PTC-1001',
                'password' => Hash::make('memberpassword'),
                'customer_name' => 'Tanmoy Saha',
                'age' => 32,
                'co_customer_name' => 'Priya Saha',
                'co_customer_age' => 28,
                'kid_1_name' => 'Rohan Saha',
                'kid_1_age' => 6,
                'kid_2_name' => 'Riya Saha',
                'kid_2_age' => 3,
                'address' => '123 Dream Valley, Salt Lake, Kolkata, West Bengal - 700091',
                'mobile_1' => '+91 98300 12345',
                'mobile_2' => '+91 98300 54321',
                'email' => 'member@premiumtravel.club',
                'membership_issue_date' => '2026-01-15',
                'membership_expiry_date' => '2031-01-15',
                'membership_category' => 'Platinum Club Elite',
                'membership_terms' => 'Includes access to 19 premium seafront hotels across Europe and the Caribbean. Valid for up to 21 nights of stay annually. Standard resort rules apply.',
                'profile_image_path' => 'images/profile.jpg',
            ]);
        }

        // 14. Seed Default Blog Posts
        if (!\App\Models\BlogPost::where('slug', 'how-yoga-supports-everyday-wellness-and-stress-relief')->exists()) {
            \App\Models\BlogPost::create([
                'title' => 'How Yoga Supports Everyday Wellness and Stress Relief',
                'slug' => 'how-yoga-supports-everyday-wellness-and-stress-relief',
                'category' => 'Yoga & Mindfulness',
                'author' => 'site.admin',
                'summary' => 'How Yoga Supports Everyday Wellness and Stress Relief In today\'s fast-paced world, finding moments of calm can feel increasingly difficult. Between constant...',
                'content' => "How Yoga Supports Everyday Wellness and Stress Relief\nIn today's fast-paced world, finding moments of calm can feel increasingly difficult. Between constant notifications, demanding schedules, and everyday responsibilities, stress has become part of daily life for many people. At The BodyHoliday, we believe wellness begins with creating space to slow down, reconnect, and care for both the mind and body, and yoga is one of the most powerful ways to do exactly that.\n\nAs the leading wellness resort in the Caribbean that travelers seek for rejuvenation, we've seen firsthand how yoga can support not only physical health, but emotional balance and mental clarity.\n\nThe Connection Between Yoga and Wellness\nYoga is so much more than just movement or a low-impact exercise; it's a holistic practice that combines breathwork, mindfulness, and intentional movement to support overall wellbeing. Whether practiced for ten minutes or an hour, yoga encourages you to become more present, grounded, and aware of your body's needs.\n\nAt The BodyHoliday, yoga is an essential part of the wellness experience we offer our guests. From peaceful sunrise sessions to restorative evening classes on our Reefside Yoga Deck overlooking the Caribbean Sea, each experience is designed to promote balance and relaxation.\n\nHow Yoga Helps Relieve Stress\nOne of the most recognized benefits of yoga is its ability to reduce stress. Gentle movement and controlled breathing help calm the nervous system, lower tension in the body, and encourage a sense of peace.\n\nGuests visiting The BodyHoliday often describe our yoga classes as a reset button, an opportunity to disconnect from outside pressures and reconnect with themselves. Combined with the serene atmosphere of one of the most peaceful beachfront resorts in Saint Lucia, yoga becomes even more restorative.",
                'image_path' => 'images/WelcomeImg-1.jpg',
                'published_at' => '2026-05-25 09:00:00',
            ]);
        }

        if (!\App\Models\BlogPost::where('slug', 'thank-you-for-donating')->exists()) {
            \App\Models\BlogPost::create([
                'title' => 'Thank You For Donating!',
                'slug' => 'thank-you-for-donating',
                'category' => 'Community Cares',
                'author' => 'site.admin',
                'summary' => 'Dear Guests, On behalf of our local community and the entire team, we would like to extend our heartfelt gratitude for your generous contribution to our...',
                'content' => "Dear Guests, On behalf of our local community and the entire team, we would like to extend our heartfelt gratitude for your generous contribution to our local schools.\n\nThanks to your kindness and support, we were able to donate essential school supplies, backpacks, and sports equipment to children in need. This contribution makes a significant difference in their learning journey and helps provide them with the tools they need to succeed.\n\nAt Premium Travel Club, we believe in giving back to the destinations that welcome us. Our community outreach programs are designed to support education, healthcare, and sustainable development in the local areas surrounding our resorts.\n\nWe are incredibly proud of our members and guests who join us in these efforts. Your generosity helps build a brighter future for the children in our host communities, and we cannot thank you enough for being a part of this journey.",
                'image_path' => 'images/WelcomeImg-3.jpg',
                'published_at' => '2026-05-18 10:00:00',
            ]);
        }

        if (!\App\Models\BlogPost::where('slug', 'the-art-of-mindful-eating')->exists()) {
            \App\Models\BlogPost::create([
                'title' => 'The Art of Mindful Eating',
                'slug' => 'the-art-of-mindful-eating',
                'category' => 'Food and Nutrition',
                'author' => 'site.admin',
                'summary' => 'At The BodyHoliday Saint Lucia, we believe that true nourishment goes beyond what\'s on your plate; it\'s about how you experience every bite. In a world that...',
                'content' => "At The BodyHoliday Saint Lucia, we believe that true nourishment goes beyond what's on your plate; it's about how you experience every bite. In a world that encourages multitasking and constant rush, mindful eating is a simple yet transformative practice that can improve your relationship with food and support your overall health.\n\nMindful eating is the practice of bringing full awareness to the experience of eating. It involves paying attention to the colors, smells, textures, and flavors of your food, as well as listening to your body's hunger and fullness cues.\n\nBy slowing down and focusing on the present moment, you can fully appreciate your meals and make choices that truly nourish your body and mind. Our culinary team is dedicated to providing delicious, health-focused options that make mindful eating a pleasure.",
                'image_path' => 'images/WelcomeImg-2.jpg',
                'published_at' => '2026-05-01 11:30:00',
            ]);
        }

        // Call the HotelsTableSeeder to populate country categories and new hotels
        $this->call([
            HotelsTableSeeder::class,
        ]);
    }
}
