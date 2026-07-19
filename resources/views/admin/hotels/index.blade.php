@extends('admin.layout')

@section('title', 'Manage Properties')

@section('content')
<div class="content-header">
  <div>
    <h1>Hotels / Properties</h1>
    <p class="subtitle">Add, edit, or remove resort and hotel properties.</p>
  </div>
  <div>
    <a href="{{ route('admin.hotels.create') }}" class="btn btn-primary">
      <i class="fas fa-plus"></i> Add New Hotel
    </a>
  </div>
</div>

<div class="card">
  <div class="card-title">
    <span>All Affiliated Hotels</span>
  </div>

  <div class="table-responsive">
    @if($hotels->isEmpty())
      <div style="text-align: center; padding: 40px; color: var(--text-muted);">
        <i class="fas fa-hotel" style="font-size: 3rem; margin-bottom: 15px; display: block;"></i>
        No hotel properties added yet.
      </div>
    @else
      <table>
        <thead>
          <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Location</th>
            <th>Country</th>
            <th>Rating</th>
            <th>Tags/Categories</th>
            <th>Sort Order</th>
            <th style="text-align: right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($hotels as $hotel)
            <tr>
              <td>
                <img src="{{ $hotel->image_url }}" alt="" style="width: 80px; height: 50px; object-fit: cover; border-radius: 4px; border: 1px solid var(--border);">
              </td>
              <td><strong>{{ $hotel->name }}</strong></td>
              <td>{{ $hotel->location }}</td>
              <td>{{ $hotel->country }}</td>
              <td>
                <span style="color: #fbbf24;">
                  @for($i = 1; $i <= 5; $i++)
                    {!! $i <= $hotel->rating ? '★' : '☆' !!}
                  @endfor
                </span>
              </td>
              <td>
                @foreach($hotel->categories as $cat)
                  <span class="badge badge-read" style="margin-right: 4px; background-color: #334155; color: #fff;">{{ $cat->name }}</span>
                @endforeach
              </td>
              <td>{{ $hotel->sort_order }}</td>
              <td>
                <div class="actions-cell" style="justify-content: flex-end;">
                  <a href="{{ route('admin.hotels.edit', $hotel->id) }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <form action="{{ route('admin.hotels.destroy', $hotel->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this hotel property?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                      <i class="fas fa-trash"></i> Delete
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>
</div>
@endsection
