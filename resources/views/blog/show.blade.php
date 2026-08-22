@extends('layouts.app')

@section('content')
<!-- Header Banner Section -->
<section style="background-color: #f7f6f2; padding: 45px 0; text-align: center; border-bottom: 1px solid #eaeaea; margin-top: 0;">
  <div class="container" style="max-width: 900px; margin: 0 auto;">
    <h1 style="font-family: 'Playfair Display', serif; font-size: 2.2rem; color: #1a1a1a; margin: 0; font-weight: 400; line-height: 1.35;">{{ $blog->title }}</h1>
  </div>
</section>

<!-- Article Details Section -->
<section class="blog-detail-section" style="padding: 60px 0; background-color: #ffffff;">
  <div class="container" style="max-width: 800px; margin: 0 auto; padding: 0 20px;">
    
    <!-- Featured Image -->
    @if($blog->image_path)
      <div class="featured-image-wrapper" style="width: 100%; margin-bottom: 30px; border-radius: 4px; overflow: hidden; border: 1px solid #f1f5f9;">
        <img src="{{ (file_exists(public_path($blog->image_path)) && $blog->image_path) ? asset($blog->image_path) : asset('storage/' . $blog->image_path) }}" alt="{{ $blog->title }}" style="width: 100%; height: auto; max-height: 500px; object-fit: cover; display: block;">
      </div>
    @endif

    <!-- Metadata Row -->
    <div style="font-size: 0.88rem; color: #64748b; margin-bottom: 15px; font-family: 'Inter', sans-serif; display: flex; gap: 8px; align-items: center;">
      <span>{{ $blog->published_at ? $blog->published_at->format('F d, Y') : $blog->created_at->format('F d, Y') }}</span>
      <span>by</span>
      <span style="font-weight: 500; color: #334155;">{{ $blog->author }}</span>
    </div>

    <!-- Title repeated under image -->
    <h2 style="font-family: 'Playfair Display', serif; font-size: 2rem; color: #1a1a1a; margin: 0 0 20px; font-weight: 500; line-height: 1.3;">
      {{ $blog->title }}
    </h2>

    <!-- Share Social Row -->
    <div class="share-row" style="display: flex; align-items: center; gap: 12px; margin-bottom: 40px; border-bottom: 1px solid #f1f5f9; padding-bottom: 25px;">
      <span style="font-size: 0.85rem; font-weight: 700; text-transform: uppercase; color: #64748b; letter-spacing: 0.5px; font-family: 'Inter', sans-serif;">Share</span>
      <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="share-icon" style="background-color: #3b5998; color: white;" aria-label="Share on Facebook">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($blog->title) }}" target="_blank" class="share-icon" style="background-color: #0f1419; color: white;" aria-label="Share on X">
        <i class="fab fa-x-twitter"></i>
      </a>
      <a href="https://api.whatsapp.com/send?text={{ urlencode($blog->title . ' - ' . request()->fullUrl()) }}" target="_blank" class="share-icon" style="background-color: #25d366; color: white;" aria-label="Share on WhatsApp">
        <i class="fab fa-whatsapp"></i>
      </a>
      <a href="#" class="share-icon" style="background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%,#d6249f 60%,#285AEB 90%); color: white;" aria-label="Share on Instagram">
        <i class="fab fa-instagram"></i>
      </a>
    </div>

    <!-- Article Content Body -->
    <div class="article-body" style="font-family: 'Inter', sans-serif; font-size: 1.05rem; line-height: 1.8; color: #334155;">
      {!! nl2br(e($blog->content)) !!}
    </div>

    <div style="margin-top: 60px; border-top: 1px solid #f1f5f9; padding-top: 40px;">
      <h3 style="font-family: 'Playfair Display', serif; font-size: 1.6rem; color: #1a1a1a; margin-bottom: 30px;">Comments ({{ $blog->comments->count() }})</h3>
      
      @if(session('success'))
        <div style="background-color: #dcfce3; color: #166534; padding: 15px; border-radius: 4px; margin-bottom: 30px; font-family: 'Inter', sans-serif;">
          {{ session('success') }}
        </div>
      @endif

      <!-- Display Comments -->
      <div style="margin-bottom: 50px;">
        @forelse($blog->comments as $comment)
          <div style="margin-bottom: 25px; padding-bottom: 25px; border-bottom: 1px solid #f1f5f9;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
              <strong style="font-family: 'Inter', sans-serif; color: #1e293b;">{{ $comment->name }}</strong>
              <span style="font-size: 0.85rem; color: #64748b;">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
            <p style="font-family: 'Inter', sans-serif; color: #475569; margin: 0; line-height: 1.6;">{{ $comment->comment }}</p>
          </div>
        @empty
          <p style="font-family: 'Inter', sans-serif; color: #64748b; font-style: italic;">No comments yet. Be the first to share your thoughts!</p>
        @endforelse
      </div>

      <!-- Comment Form -->
      <h4 style="font-family: 'Playfair Display', serif; font-size: 1.4rem; color: #1a1a1a; margin-bottom: 20px;">Leave a Reply</h4>
      <form action="{{ route('blog.comment.store', $blog->slug) }}" method="POST" style="font-family: 'Inter', sans-serif;">
        @csrf
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
          <div>
            <label for="name" style="display: block; font-size: 0.9rem; font-weight: 500; color: #334155; margin-bottom: 8px;">Name <span style="color: #e11d48;">*</span></label>
            <input type="text" name="name" id="name" required style="width: 100%; padding: 12px 15px; border: 1px solid #cbd5e1; border-radius: 4px; font-family: inherit; font-size: 0.95rem; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#1e3a8a'" onblur="this.style.borderColor='#cbd5e1'">
            @error('name')<span style="color: #e11d48; font-size: 0.85rem;">{{ $message }}</span>@enderror
          </div>
          <div>
            <label for="email" style="display: block; font-size: 0.9rem; font-weight: 500; color: #334155; margin-bottom: 8px;">Email <span style="color: #e11d48;">*</span> <span style="font-weight: 400; color: #94a3b8;">(will not be published)</span></label>
            <input type="email" name="email" id="email" required style="width: 100%; padding: 12px 15px; border: 1px solid #cbd5e1; border-radius: 4px; font-family: inherit; font-size: 0.95rem; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#1e3a8a'" onblur="this.style.borderColor='#cbd5e1'">
            @error('email')<span style="color: #e11d48; font-size: 0.85rem;">{{ $message }}</span>@enderror
          </div>
        </div>
        <div style="margin-bottom: 20px;">
          <label for="comment" style="display: block; font-size: 0.9rem; font-weight: 500; color: #334155; margin-bottom: 8px;">Comment <span style="color: #e11d48;">*</span></label>
          <textarea name="comment" id="comment" rows="5" required style="width: 100%; padding: 12px 15px; border: 1px solid #cbd5e1; border-radius: 4px; font-family: inherit; font-size: 0.95rem; resize: vertical; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#1e3a8a'" onblur="this.style.borderColor='#cbd5e1'"></textarea>
          @error('comment')<span style="color: #e11d48; font-size: 0.85rem;">{{ $message }}</span>@enderror
        </div>
        <button type="submit" style="background-color: #1e3a8a; color: white; border: none; padding: 12px 25px; border-radius: 4px; font-family: inherit; font-weight: 500; font-size: 0.95rem; cursor: pointer; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#172554'" onmouseout="this.style.backgroundColor='#1e3a8a'">Post Comment</button>
      </form>
    </div>

    <div style="margin-top: 60px; border-top: 1px solid #f1f5f9; padding-top: 30px;">
      <a href="{{ route('blog.index') }}" style="font-family: 'Inter', sans-serif; font-size: 0.9rem; font-weight: 600; color: #1e3a8a; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
        <i class="fas fa-arrow-left"></i> Back to all articles
      </a>
    </div>

  </div>
</section>

<style>
  .share-icon {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    font-size: 0.9rem;
    transition: transform 0.2s ease, opacity 0.2s ease;
  }
  .share-icon:hover {
    transform: translateY(-2px);
    opacity: 0.9;
  }
  .article-body p {
    margin-bottom: 25px;
  }
  .article-body h3 {
    font-family: 'Playfair Display', serif;
    font-size: 1.5rem;
    color: #1a1a1a;
    margin: 40px 0 15px;
    font-weight: 500;
    line-height: 1.3;
  }
</style>
@endsection
