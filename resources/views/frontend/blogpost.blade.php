@extends('frontend.layout.app')

@section('title', 'Blog Posts')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-5 fw-bold mb-3">Our Blog</h1>
            <p class="lead text-muted">
                Latest insights, tutorials, and updates
            </p>
        </div>
    </div>

    <div class="row">
        @forelse($posts as $post)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <!-- Post Image -->
                <div class="position-relative">
                    <img src="{{ $post->image ? asset('storage/' . $post->image) : asset('images/default-blog.jpg') }}" 
                         class="card-img-top" 
                         alt="{{ $post->title }}"
                         style="height: 250px; object-fit: cover;">
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge bg-primary">
                            <i class="far fa-comments me-1"></i>
                            {{ $post->comments_count }}
                        </span>
                    </div>
                </div>
                
                <div class="card-body">
                    <!-- Post Meta -->
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <small class="text-muted">
                            <i class="far fa-calendar me-1"></i>
                            {{ $post->created_at->format('M d, Y') }}
                        </small>
                        @if($post->subtitle)
                            <small class="text-primary fw-bold">{{ $post->subtitle }}</small>
                        @endif
                    </div>
                    
                    <!-- Post Title -->
                    <h5 class="card-title fw-bold">{{ $post->title }}</h5>
                    
                    <!-- Excerpt -->
                    <p class="card-text text-muted">
                        {{ $post->excerpt ?: Str::limit(strip_tags($post->content), 120) }}
                    </p>
                </div>
                
                <div class="card-footer bg-white border-top-0 pt-0">
                    <a href="{{ route('blog.show', $post->slug) }}" 
                       class="btn btn-primary w-100">
                        <i class="fas fa-book-reader me-2"></i>Read Full Article
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="text-center py-5">
                <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                <h4>No blog posts yet</h4>
                <p class="text-muted">Check back soon for new articles!</p>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($posts->hasPages())
    <div class="row mt-5">
        <div class="col-12">
            <nav aria-label="Page navigation">
                {{ $posts->links() }}
            </nav>
        </div>
    </div>
    @endif
</div>
@endsection