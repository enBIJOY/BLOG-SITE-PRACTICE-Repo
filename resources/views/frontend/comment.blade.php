<div class="comment mb-4" data-id="{{ $comment->id }}">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div>
                    <h6 class="card-subtitle mb-1 text-primary">{{ $comment->name }}</h6>
                    <small class="text-muted">
                        {{ $comment->created_at->diffForHumans() }}
                    </small>
                </div>
                <button class="btn btn-sm btn-outline-primary reply-btn"
                        data-id="{{ $comment->id }}"
                        data-name="{{ $comment->name }}">
                    <i class="fas fa-reply me-1"></i>Reply
                </button>
            </div>
            
            <p class="card-text mb-3">{{ $comment->content }}</p>
        </div>
    </div>
    
    <!-- Replies -->
    @if($comment->replies->count() > 0)
        <div class="comment-replies mt-3">
            @foreach($comment->replies as $reply)
                <div class="comment mb-3" data-id="{{ $reply->id }}">
                    <div class="card border-start border-primary">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h6 class="card-subtitle mb-1 text-primary">
                                        {{ $reply->name }}
                                        <small class="text-muted">
                                            <i class="fas fa-reply mx-1"></i>
                                            replying to {{ $comment->name }}
                                        </small>
                                    </h6>
                                    <small class="text-muted">
                                        {{ $reply->created_at->diffForHumans() }}
                                    </small>
                                </div>
                                <button class="btn btn-sm btn-outline-primary reply-btn"
                                        data-id="{{ $comment->id }}"
                                        data-name="{{ $comment->name }}">
                                    <i class="fas fa-reply me-1"></i>Reply
                                </button>
                            </div>
                            <p class="card-text">{{ $reply->content }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>