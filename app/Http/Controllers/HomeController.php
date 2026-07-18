<?php

namespace App\Http\Controllers;

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
use App\Models\ContactMessage;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private function getCommonData()
    {
        return [
            'settings' => SiteSetting::first() ?? new SiteSetting(),
        ];
    }

    public function home()
    {
        $data = $this->getCommonData();
        $data['hero'] = HeroSection::first() ?? new HeroSection();
        $data['welcome'] = WelcomeSection::first() ?? new WelcomeSection();
        $data['destinations'] = Destination::orderBy('sort_order')->orderBy('name')->get();
        $data['testimonials'] = Testimonial::where('type', 'home')->orderBy('sort_order')->get();
        
        // Prepare Hotel Tab Data for the interactive tab menu
        $categories = HotelCategory::all();
        $hotelTabData = [];
        
        foreach ($categories as $cat) {
            $hotels = $cat->hotels()->orderBy('sort_order')->get()->map(function ($hotel) {
                return [
                    'title' => $hotel->name,
                    'location' => $hotel->location,
                    'stars' => $hotel->rating,
                    'text' => $hotel->description,
                    'image' => (file_exists(public_path($hotel->image_path)) && $hotel->image_path) ? asset($hotel->image_path) : asset('storage/' . $hotel->image_path),
                    'layout' => $hotel->id % 2 === 0 ? 'media-first' : 'text-first'
                ];
            });
            $hotelTabData[$cat->slug] = $hotels;
        }
        
        $data['hotelTabData'] = $hotelTabData;
        $data['categories'] = $categories;
        
        return view('home', $data);
    }

    public function hotels(Request $request)
    {
        $data = $this->getCommonData();
        
        // Hardcode the requested countries to guarantee they always appear as tabs
        $countries = ['India', 'Bali', 'Sri Lanka', 'Malaysia', 'Nepal', 'Thailand', 'Indonesia', 'Bhutan'];
        
        $hotelsByCountry = collect();
        $allHotels = Hotel::orderBy('sort_order')->get();
        
        foreach ($countries as $country) {
            $matchedHotels = $allHotels->filter(function($hotel) use ($country) {
                return strtolower(trim($hotel->country)) === strtolower(trim($country));
            });
            $hotelsByCountry->put($country, $matchedHotels);
        }
        
        $data['hotelsByCountry'] = $hotelsByCountry;
        
        // Active country for tab highlighting
        $data['activeCountry'] = $request->get('country', 'India');
        
        return view('hotels', $data);
    }

    public function destinationsPage()
    {
        $data = $this->getCommonData();
        $data['destinations'] = Destination::orderBy('sort_order')->get();
        return view('destinations', $data);
    }

    public function benefits()
    {
        $data = $this->getCommonData();
        $data['welcome'] = WelcomeSection::first() ?? new WelcomeSection();
        $data['benefits'] = Benefit::orderBy('sort_order')->get();
        return view('benefits', $data);
    }

    public function awards()
    {
        $data = $this->getCommonData();
        $data['awards'] = Award::orderBy('sort_order')->get();
        $data['stats'] = Stat::orderBy('sort_order')->get();
        return view('awards', $data);
    }

    public function about()
    {
        $data = $this->getCommonData();
        $data['about'] = AboutSection::first() ?? new AboutSection();
        $data['testimonials'] = Testimonial::where('type', 'about')->orderBy('sort_order')->get();
        return view('about', $data);
    }

    public function contact()
    {
        $data = $this->getCommonData();
        return view('contact', $data);
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        ContactMessage::create($request->all());

        if ($request->ajax()) {
            return response()->json(['success' => 'Thank you for getting in touch! We will get back to you shortly.']);
        }

        return redirect()->back()->with('success', 'Thank you for getting in touch! We will get back to you shortly.');
    }

    public function blogIndex()
    {
        $data = $this->getCommonData();
        $data['blogs'] = BlogPost::orderBy('published_at', 'desc')->get();
        return view('blog.index', $data);
    }

    public function blogShow($slug)
    {
        $data = $this->getCommonData();
        $data['blog'] = BlogPost::where('slug', $slug)->firstOrFail();
        return view('blog.show', $data);
    }
}
