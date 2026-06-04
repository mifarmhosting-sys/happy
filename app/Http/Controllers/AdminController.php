<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\HeroSection;
use App\Models\WelcomeSection;
use App\Models\AboutSection;
use App\Models\ContactMessage;
use App\Models\Hotel;
use App\Models\Destination;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login', [
            'settings' => SiteSetting::first() ?? new SiteSetting(),
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->get();
        $unreadCount = ContactMessage::whereNull('read_at')->count();
        $hotelsCount = Hotel::count();
        $destinationsCount = Destination::count();
        $testimonialsCount = Testimonial::count();

        return view('admin.dashboard', [
            'messages' => $messages,
            'unreadCount' => $unreadCount,
            'hotelsCount' => $hotelsCount,
            'destinationsCount' => $destinationsCount,
            'testimonialsCount' => $testimonialsCount,
            'settings' => SiteSetting::first() ?? new SiteSetting(),
        ]);
    }

    public function viewMessage($id)
    {
        $message = ContactMessage::findOrFail($id);
        if (!$message->read_at) {
            $message->update(['read_at' => now()]);
        }
        return view('admin.message-detail', [
            'message' => $message,
            'settings' => SiteSetting::first() ?? new SiteSetting(),
        ]);
    }

    public function deleteMessage($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Message deleted successfully.');
    }

    public function editSettings()
    {
        return view('admin.settings', [
            'settings' => SiteSetting::first() ?? new SiteSetting(),
        ]);
    }

    public function updateSettings(Request $request)
    {
        $settings = SiteSetting::first() ?? new SiteSetting();

        $rules = [
            'site_name' => 'required|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:50',
            'contact_address' => 'nullable|string',
            'working_hours' => 'nullable|string|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'footer_blurb' => 'nullable|string',
        ];

        $request->validate($rules);
        $data = $request->all();

        $settings->fill($data)->save();

        return redirect()->back()->with('success', 'Site settings updated successfully.');
    }

    public function editHomepage()
    {
        return view('admin.homepage', [
            'hero' => HeroSection::first() ?? new HeroSection(),
            'welcome' => WelcomeSection::first() ?? new WelcomeSection(),
            'settings' => SiteSetting::first() ?? new SiteSetting(),
        ]);
    }

    public function updateHomepage(Request $request)
    {
        $hero = HeroSection::first() ?? new HeroSection();
        $welcome = WelcomeSection::first() ?? new WelcomeSection();

        $request->validate([
            'hero_eyebrow' => 'nullable|string|max:255',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:255',
            'hero_video' => 'nullable|mimes:mp4,webm,ogg|max:51200', // max 50MB
            
            'welcome_tagline' => 'nullable|string|max:255',
            'welcome_title' => 'nullable|string|max:255',
            'welcome_description1' => 'nullable|string',
            'welcome_description2' => 'nullable|string',
            'welcome_accent_text' => 'nullable|string',
            'welcome_img1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'welcome_img2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'welcome_img3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'welcome_img4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        // Hero Update
        $heroData = [
            'eyebrow' => $request->hero_eyebrow,
            'title' => $request->hero_title,
            'subtitle' => $request->hero_subtitle,
        ];
        if ($request->hasFile('hero_video')) {
            if ($hero->video_path && Storage::disk('public')->exists($hero->video_path) && strpos($hero->video_path, 'video.mp4') === false) {
                Storage::disk('public')->delete($hero->video_path);
            }
            $heroData['video_path'] = $request->file('hero_video')->store('videos', 'public');
        }
        $hero->fill($heroData)->save();

        // Welcome Section Update
        $welcomeData = [
            'tagline' => $request->welcome_tagline,
            'title' => $request->welcome_title,
            'description1' => $request->welcome_description1,
            'description2' => $request->welcome_description2,
            'accent_text' => $request->welcome_accent_text,
        ];

        for ($i = 1; $i <= 4; $i++) {
            $inputName = "welcome_img{$i}";
            if ($request->hasFile($inputName)) {
                $dbField = "image{$i}_path";
                if ($welcome->$dbField && Storage::disk('public')->exists($welcome->$dbField)) {
                    Storage::disk('public')->delete($welcome->$dbField);
                }
                $welcomeData[$dbField] = $request->file($inputName)->store('images', 'public');
            }
        }
        $welcome->fill($welcomeData)->save();

        return redirect()->back()->with('success', 'Homepage content updated successfully.');
    }

    public function editAbout()
    {
        return view('admin.about', [
            'about' => AboutSection::first() ?? new AboutSection(),
            'settings' => SiteSetting::first() ?? new SiteSetting(),
        ]);
    }

    public function updateAbout(Request $request)
    {
        $about = AboutSection::first() ?? new AboutSection();

        $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description1' => 'nullable|string',
            'description2' => 'nullable|string',
            'description3' => 'nullable|string',
            'amenities_title' => 'nullable|string|max:255',
            'amenities_description' => 'nullable|string',
            'amenities_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'offers_title' => 'nullable|string|max:255',
            'offers_description' => 'nullable|string',
            'offers_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        $data = $request->except(['amenities_image', 'offers_image']);

        if ($request->hasFile('amenities_image')) {
            if ($about->amenities_image_path && Storage::disk('public')->exists($about->amenities_image_path)) {
                Storage::disk('public')->delete($about->amenities_image_path);
            }
            $data['amenities_image_path'] = $request->file('amenities_image')->store('images', 'public');
        }

        if ($request->hasFile('offers_image')) {
            if ($about->offers_image_path && Storage::disk('public')->exists($about->offers_image_path)) {
                Storage::disk('public')->delete($about->offers_image_path);
            }
            $data['offers_image_path'] = $request->file('offers_image')->store('images', 'public');
        }

        $about->fill($data)->save();

        return redirect()->back()->with('success', 'About page content updated successfully.');
    }
}
