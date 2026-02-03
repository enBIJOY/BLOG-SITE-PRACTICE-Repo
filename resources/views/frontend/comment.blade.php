<!-- resources/views/blog/partials/comment.blade.php -->
<div class="comment mb-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h6 class="card-subtitle mb-2 text-primary">{{ $comment->name }}</h6>
                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
            </div>
            <p class="card-text">{{ $comment->content }}</p>
            <button class="btn btn-sm btn-outline-primary reply-btn"
                data-id="{{ $comment->id }}"
                data-name="{{ $comment->name }}">
                Reply
            </button>
        </div>
    </div>
    
    <!-- Replies -->
    @if($comment->replies->count() > 0)
        <div class="comment-reply mt-3">
            @foreach($comment->replies as $reply)
                @include('blog.partials.comment', ['comment' => $reply])
            @endforeach
        </div>
    @endif
</div>