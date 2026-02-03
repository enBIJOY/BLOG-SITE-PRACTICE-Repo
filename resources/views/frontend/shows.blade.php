<!-- resources/views/blog/show.blade.php -->
@extends('frontend.layout.app')

@section('title', $post->title)

@section('content')
<div class="row">
    <div class="col-lg-8">
        <article class="card mb-4">
            <div class="card-body">
                <h1 class="card-title">{{ $post->title }}</h1>
                <p class="text-muted">
                    Published on {{ $post->created_at->format('F j, Y') }}
                </p>
                <div class="content">
                    {!! nl2br(e($post->content)) !!}
                </div>
            </div>
        </article>

        <!-- Comments Section -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    Comments ({{ $post->comments->count() + $post->allComments->count() - $post->comments->count() }})
                </h5>
            </div>
            <div class="card-body">
                
                <!-- Comment Form -->
                <div class="mb-4">
                    <h6>Add a Comment</h6>
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="commentable_type" value="App\Models\Post">
                        <input type="hidden" name="commentable_id" value="{{ $post->id }}">
                        <input type="hidden" name="parent_id" value="">
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                       placeholder="Your Name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                       placeholder="Your Email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <textarea name="content" class="form-control @error('content') is-invalid @enderror" 
                                          rows="3" placeholder="Your Comment">{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Submit Comment</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Comments List -->
                @if($post->comments->count() > 0)
                    <div class="comments-list">
                        @foreach($post->comments as $comment)
                            @include('blog.partials.comment', ['comment' => $comment])
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">No comments yet. Be the first to comment!</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function replyToComment(commentId, commenterName) {
        document.querySelector('input[name="parent_id"]').value = commentId;
        document.querySelector('textarea[name="content"]').placeholder = 'Reply to ' + commenterName + '...';
        document.querySelector('textarea[name="content"]').focus();
    }
</script>
@endpush