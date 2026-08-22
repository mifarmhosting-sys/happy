<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = BlogPost::orderBy('published_at', 'desc')->get();
        $settings = SiteSetting::first() ?? new SiteSetting();
        return view('admin.blogs.index', compact('blogs', 'settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $settings = SiteSetting::first() ?? new SiteSetting();
        return view('admin.blogs.create', compact('settings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'summary' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        $data = $request->except(['image']);
        $data['slug'] = BlogPost::generateUniqueSlug($request->title);
        $data['published_at'] = now();

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('images', 'public');
        }

        BlogPost::create($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = BlogPost::findOrFail($id);
        $settings = SiteSetting::first() ?? new SiteSetting();
        return view('admin.blogs.edit', compact('blog', 'settings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $blog = BlogPost::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'summary' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        $data = $request->except(['image']);
        
        // Regenerate slug only if title changes
        if ($blog->title !== $request->title) {
            $data['slug'] = BlogPost::generateUniqueSlug($request->title);
        }

        if ($request->hasFile('image')) {
            // Delete old image if it exists in storage (not seeded public image)
            if ($blog->image_path && Storage::disk('public')->exists($blog->image_path)) {
                Storage::disk('public')->delete($blog->image_path);
            }
            $data['image_path'] = $request->file('image')->store('images', 'public');
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = BlogPost::findOrFail($id);

        // Delete cover image from storage
        if ($blog->image_path && Storage::disk('public')->exists($blog->image_path)) {
            Storage::disk('public')->delete($blog->image_path);
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post deleted successfully.');
    }

    public function commentsIndex()
    {
        $comments = \App\Models\BlogComment::with('post')->orderBy('created_at', 'desc')->get();
        $settings = SiteSetting::first() ?? new SiteSetting();
        return view('admin.blogs.comments', compact('comments', 'settings'));
    }

    public function commentApprove(Request $request, $id)
    {
        $comment = \App\Models\BlogComment::findOrFail($id);
        $comment->is_approved = true;
        $comment->save();

        return redirect()->back()->with('success', 'Comment approved successfully.');
    }

    public function commentDestroy($id)
    {
        $comment = \App\Models\BlogComment::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}
