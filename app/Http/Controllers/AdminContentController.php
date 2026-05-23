<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Testimonial;
use App\Models\Benefit;
use App\Models\Award;
use App\Models\Stat;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminContentController extends Controller
{
    // === DESTINATIONS ===
    public function destinationsIndex()
    {
        return view('admin.destinations.index', [
            'destinations' => Destination::orderBy('sort_order')->get(),
            'settings' => SiteSetting::first() ?? new SiteSetting(),
        ]);
    }

    public function destinationStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096',
            'sort_order' => 'required|integer',
        ]);

        $data = $request->except(['image']);
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('images', 'public');
        }

        Destination::create($data);
        return redirect()->route('admin.destinations.index')->with('success', 'Destination created successfully.');
    }

    public function destinationEdit($id)
    {
        return view('admin.destinations.edit', [
            'destination' => Destination::findOrFail($id),
            'settings' => SiteSetting::first() ?? new SiteSetting(),
        ]);
    }

    public function destinationUpdate(Request $request, $id)
    {
        $d = Destination::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'sort_order' => 'required|integer',
        ]);

        $data = $request->except(['image']);
        if ($request->hasFile('image')) {
            if ($d->image_path && Storage::disk('public')->exists($d->image_path)) {
                Storage::disk('public')->delete($d->image_path);
            }
            $data['image_path'] = $request->file('image')->store('images', 'public');
        }

        $d->update($data);
        return redirect()->route('admin.destinations.index')->with('success', 'Destination updated successfully.');
    }

    public function destinationDestroy($id)
    {
        $d = Destination::findOrFail($id);
        if ($d->image_path && Storage::disk('public')->exists($d->image_path)) {
            Storage::disk('public')->delete($d->image_path);
        }
        $d->delete();
        return redirect()->route('admin.destinations.index')->with('success', 'Destination deleted successfully.');
    }

    // === TESTIMONIALS ===
    public function testimonialsIndex()
    {
        return view('admin.testimonials.index', [
            'testimonials' => Testimonial::orderBy('type')->orderBy('sort_order')->get(),
            'settings' => SiteSetting::first() ?? new SiteSetting(),
        ]);
    }

    public function testimonialStore(Request $request)
    {
        $request->validate([
            'quote' => 'required|string',
            'author' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'type' => 'required|in:home,about',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sort_order' => 'required|integer',
        ]);

        $data = $request->except(['image']);
        if ($request->hasFile('image')) {
            $data['avatar_path'] = $request->file('image')->store('images', 'public');
        }

        Testimonial::create($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial added successfully.');
    }

    public function testimonialEdit($id)
    {
        return view('admin.testimonials.edit', [
            'testimonial' => Testimonial::findOrFail($id),
            'settings' => SiteSetting::first() ?? new SiteSetting(),
        ]);
    }

    public function testimonialUpdate(Request $request, $id)
    {
        $t = Testimonial::findOrFail($id);
        $request->validate([
            'quote' => 'required|string',
            'author' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'type' => 'required|in:home,about',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sort_order' => 'required|integer',
        ]);

        $data = $request->except(['image']);
        if ($request->hasFile('image')) {
            if ($t->avatar_path && Storage::disk('public')->exists($t->avatar_path)) {
                Storage::disk('public')->delete($t->avatar_path);
            }
            $data['avatar_path'] = $request->file('image')->store('images', 'public');
        }

        $t->update($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    public function testimonialDestroy($id)
    {
        $t = Testimonial::findOrFail($id);
        if ($t->avatar_path && Storage::disk('public')->exists($t->avatar_path)) {
            Storage::disk('public')->delete($t->avatar_path);
        }
        $t->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }

    // === BENEFITS ===
    public function benefitsIndex()
    {
        return view('admin.benefits.index', [
            'benefits' => Benefit::orderBy('sort_order')->get(),
            'settings' => SiteSetting::first() ?? new SiteSetting(),
        ]);
    }

    public function benefitStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'sort_order' => 'required|integer',
        ]);

        $data = $request->except(['icon']);
        if ($request->hasFile('icon')) {
            $data['icon_path'] = $request->file('icon')->store('images', 'public');
        }

        Benefit::create($data);
        return redirect()->route('admin.benefits.index')->with('success', 'Benefit item created successfully.');
    }

    public function benefitEdit($id)
    {
        return view('admin.benefits.edit', [
            'benefit' => Benefit::findOrFail($id),
            'settings' => SiteSetting::first() ?? new SiteSetting(),
        ]);
    }

    public function benefitUpdate(Request $request, $id)
    {
        $b = Benefit::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'sort_order' => 'required|integer',
        ]);

        $data = $request->except(['icon']);
        if ($request->hasFile('icon')) {
            if ($b->icon_path && Storage::disk('public')->exists($b->icon_path)) {
                Storage::disk('public')->delete($b->icon_path);
            }
            $data['icon_path'] = $request->file('icon')->store('images', 'public');
        }

        $b->update($data);
        return redirect()->route('admin.benefits.index')->with('success', 'Benefit item updated successfully.');
    }

    public function benefitDestroy($id)
    {
        $b = Benefit::findOrFail($id);
        if ($b->icon_path && Storage::disk('public')->exists($b->icon_path)) {
            Storage::disk('public')->delete($b->icon_path);
        }
        $b->delete();
        return redirect()->route('admin.benefits.index')->with('success', 'Benefit item deleted successfully.');
    }

    // === AWARDS & STATS ===
    public function awardsIndex()
    {
        return view('admin.awards.index', [
            'awards' => Award::orderBy('sort_order')->get(),
            'stats' => Stat::orderBy('sort_order')->get(),
            'settings' => SiteSetting::first() ?? new SiteSetting(),
        ]);
    }

    public function awardStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon_class' => 'required|string|max:255',
            'sort_order' => 'required|integer',
        ]);

        Award::create($request->all());
        return redirect()->route('admin.awards.index')->with('success', 'Award/Achievement created successfully.');
    }

    public function awardEdit($id)
    {
        return view('admin.awards.edit', [
            'award' => Award::findOrFail($id),
            'settings' => SiteSetting::first() ?? new SiteSetting(),
        ]);
    }

    public function awardUpdate(Request $request, $id)
    {
        $a = Award::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon_class' => 'required|string|max:255',
            'sort_order' => 'required|integer',
        ]);

        $a->update($request->all());
        return redirect()->route('admin.awards.index')->with('success', 'Award updated successfully.');
    }

    public function awardDestroy($id)
    {
        $a = Award::findOrFail($id);
        $a->delete();
        return redirect()->route('admin.awards.index')->with('success', 'Award deleted successfully.');
    }

    // --- STATS ---
    public function statStore(Request $request)
    {
        $request->validate([
            'value' => 'required|string|max:50',
            'label' => 'required|string|max:255',
            'sort_order' => 'required|integer',
        ]);

        Stat::create($request->all());
        return redirect()->route('admin.awards.index')->with('success', 'Statistic metric created successfully.');
    }

    public function statEdit($id)
    {
        return view('admin.awards.edit-stat', [
            'stat' => Stat::findOrFail($id),
            'settings' => SiteSetting::first() ?? new SiteSetting(),
        ]);
    }

    public function statUpdate(Request $request, $id)
    {
        $s = Stat::findOrFail($id);
        $request->validate([
            'value' => 'required|string|max:50',
            'label' => 'required|string|max:255',
            'sort_order' => 'required|integer',
        ]);

        $s->update($request->all());
        return redirect()->route('admin.awards.index')->with('success', 'Statistic metric updated successfully.');
    }

    public function statDestroy($id)
    {
        $s = Stat::findOrFail($id);
        $s->delete();
        return redirect()->route('admin.awards.index')->with('success', 'Statistic metric deleted successfully.');
    }
}
