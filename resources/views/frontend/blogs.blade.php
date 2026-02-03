<!-- resources/views/blog/index.blade.php -->
@extends('frontend.layout.app')

@section('title', 'Blog Posts')

@section('content')
<div class="row mt-5">
    <div class="col-12 mt-5">
        <h1 class="mb-4">Latest Blog Posts</h1>
    </div>
</div>

<div class="row">
    @foreach($posts as $post)
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">
                    {{ $post->excerpt ?: Str::limit(strip_tags($post->content), 150) }}
                </p>
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        {{ $post->created_at->format('M d, Y') }}
                    </small>
                    <span class="badge bg-primary">
                        {{ $post->comments_count }} comments
                    </span>
                </div>
            </div>
            <div class="card-footer bg-transparent border-top-0">
                <a href="{{ route('frontend.blogs', $post->slug) }}" class="btn btn-primary">Read More</a>
            </div>
        </div>
    </div>
    @endforeach
</div>

@if($posts->hasPages())
<div class="row">
    <div class="col-12">
        <nav aria-label="Page navigation">
            {{ $posts->links() }}
        </nav>
    </div>
</div>
@endif
@endsection