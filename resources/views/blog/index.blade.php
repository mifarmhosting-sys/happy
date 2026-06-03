@extends('layouts.app')

@section('content')
<!-- Header Banner Section -->
<section style="background-color: #f7f6f2; padding: 50px 0; text-align: center; border-bottom: 1px solid #eaeaea; margin-top: 0;">
  <div class="container">
    <h1 style="font-family: 'Playfair Display', serif; font-size: 2.4rem; color: #222222; margin: 0; font-weight: 400; letter-spacing: 0.5px;">Blog</h1>
  </div>
</section>

<!-- Blog Grid Section -->
<section class="blog-section" style="padding: 70px 0; background-color: #ffffff;">
  <div class="container">
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 40px;">
      @foreach($blogs as $post)
        <div class="blog-card" style="display: flex; flex-direction: column; background: #ffffff;">
          <!-- Card Image -->
          <div class="blog-card-image" style="overflow: hidden; height: 230px; margin-bottom: 20px; border-radius: 2px;">
            <a href="{{ route('blog.show', $post->slug) }}">
              <img src="{{ (file_exists(public_path($post->image_path)) && $post->image_path) ? asset($post->image_path) : asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;">
            </a>
          </div>

          <!-- Card Content -->
          <div class="blog-card-content" style="display: flex; flex-direction: column; flex: 1;">
            <!-- Category and Date -->
            <span style="font-size: 0.85rem; color: #1e3a8a; font-family: 'Inter', sans-serif; font-weight: 500; margin-bottom: 10px;">
              {{ $post->published_at ? $post->published_at->format('F d, Y') : $post->created_at->format('F d, Y') }} | <span style="color: #64748b; font-weight: normal;">{{ $post->category }}</span>
            </span>

            <!-- Title -->
            <h3 style="font-family: 'Playfair Display', serif; font-size: 1.5rem; line-height: 1.35; font-weight: 500; margin-bottom: 12px; color: #1a1a1a;">
              <a href="{{ route('blog.show', $post->slug) }}" style="text-decoration: none; color: inherit; transition: opacity 0.2s ease;">
                {{ $post->title }}
              </a>
            </h3>

            <!-- Summary Text -->
            <p style="font-size: 0.95rem; line-height: 1.6; color: #64748b; font-family: 'Inter', sans-serif; margin-bottom: 20px; flex: 1;">
              {{ $post->summary }}
            </p>

            <!-- Read More Link -->
            <a href="{{ route('blog.show', $post->slug) }}" style="font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #1e3a8a; text-decoration: none; margin-top: auto; display: inline-flex; align-items: center; gap: 5px;">
              Read More +
            </a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<style>
  .blog-card-image img:hover {
    transform: scale(1.03);
  }
  .blog-card h3 a:hover {
    opacity: 0.8;
  }
</style>
@endsection
