<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelCategory;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminHotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::orderBy('country')->orderBy('sort_order')->get();
        return view('admin.hotels.index', [
            'hotels' => $hotels,
            'settings' => SiteSetting::first() ?? new SiteSetting(),
        ]);
    }

    public function create()
    {
        $categories = HotelCategory::all();
        return view('admin.hotels.create', [
            'categories' => $categories,
            'settings' => SiteSetting::first() ?? new SiteSetting(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'location' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096',
            'view_url' => 'nullable|string',
            'sort_order' => 'required|integer',
            'categories' => 'required|array',
        ]);

        $data = $request->except(['image', 'categories']);
        
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('images', 'public');
        }

        $hotel = Hotel::create($data);
        $hotel->categories()->sync($request->categories);

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel property created successfully.');
    }

    public function edit($id)
    {
        $hotel = Hotel::findOrFail($id);
        $categories = HotelCategory::all();
        return view('admin.hotels.edit', [
            'hotel' => $hotel,
            'categories' => $categories,
            'settings' => SiteSetting::first() ?? new SiteSetting(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'location' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'view_url' => 'nullable|string',
            'sort_order' => 'required|integer',
            'categories' => 'required|array',
        ]);

        $data = $request->except(['image', 'categories']);

        if ($request->hasFile('image')) {
            if ($hotel->image_path && Storage::disk('public')->exists($hotel->image_path)) {
                Storage::disk('public')->delete($hotel->image_path);
            }
            $data['image_path'] = $request->file('image')->store('images', 'public');
        }

        $hotel->update($data);
        $hotel->categories()->sync($request->categories);

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel property updated successfully.');
    }

    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);

        if ($hotel->image_path && Storage::disk('public')->exists($hotel->image_path)) {
            Storage::disk('public')->delete($hotel->image_path);
        }

        $hotel->categories()->detach();
        $hotel->delete();

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel property deleted successfully.');
    }
}
