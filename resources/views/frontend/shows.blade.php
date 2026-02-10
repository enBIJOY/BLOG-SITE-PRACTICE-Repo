@extends('frontend.layout.app')

@section('title', $post->title)

@section('content')
<div class="container mt-5">
    <div class="row py-5">
        <!-- Main Content -->
        <div class="col-lg-8 mx-auto">
            <!-- Blog Post -->
            <article class="card shadow border-0 mb-5">
                <!-- Featured Image -->
                @if($post->image)
                <div class="post-image">
                    <img src="{{ asset('storage/' . $post->image) }}" 
                         class="card-img-top rounded-top" 
                         alt="{{ $post->title }}"
                         style="max-height: 500px; object-fit: cover;">
                </div>
                @endif
                
                <div class="card-body p-4">
                    <!-- Post Header -->
                    <div class="post-header mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <small class="text-muted">
                                    <i class="far fa-calendar me-1"></i>
                                    {{ $post->created_at->format('F j, Y') }}
                                </small>
                            </div>
                            <div>
                                <span class="badge bg-primary">
                                    <i class="far fa-comments me-1"></i>
                                    {{ $post->allComments->count() }} Comments
                                </span>
                            </div>
                        </div>
                        
                        <h1 class="display-6 fw-bold mb-3">{{ $post->title }}</h1>
                        
                        @if($post->subtitle)
                            <h3 class="text-muted mb-4">{{ $post->subtitle }}</h3>
                        @endif
                    </div>
                    
                    <!-- Post Content -->
                    <div class="post-content fs-5 lh-base mb-5">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                </div>
            </article>

            <!-- Comments Section -->
            <div class="card shadow border-0">
                <div class="card-body p-4">
                    <h4 class="mb-4">
                        <i class="far fa-comments me-2"></i>
                        Comments (<span id="comment-count">{{ $post->allComments->count() }}</span>)
                    </h4>
                    
                    <!-- Comment Form -->
                    <div class="comment-form mb-5 p-4 bg-light rounded">
                        <h5 class="mb-3">Leave a Comment</h5>
                        <form id="commentForm" method="POST">
                            @csrf
                            <input type="hidden" name="commentable_type" value="App\Models\Post">
                            <input type="hidden" name="commentable_id" value="{{ $post->id }}">
                            <input type="hidden" name="parent_id" id="parent_id" value="">
                            
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <input type="text" name="name" id="name" 
                                           class="form-control" 
                                           placeholder="Your Name *" required>
                                    <div class="invalid-feedback" id="name-error"></div>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="email" id="email" 
                                           class="form-control" 
                                           placeholder="Your Email *" required>
                                    <div class="invalid-feedback" id="email-error"></div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <textarea name="content" id="content" 
                                          class="form-control" 
                                          rows="4" 
                                          placeholder="Write your comment here... *" required></textarea>
                                <div class="invalid-feedback" id="content-error"></div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">* Required fields</small>
                                <button type="submit" class="btn btn-primary px-4" id="submitBtn">
                                    <span id="submitText">Post Comment</span>
                                    <span id="loadingSpinner" class="d-none">
                                        <span class="spinner-border spinner-border-sm" role="status"></span>
                                        Posting...
                                    </span>
                                </button>
                            </div>
                            
                            <!-- Reply Indicator -->
                            <div id="replyingTo" class="alert alert-info mt-3 d-none">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Replying to: <strong id="reply-to-name"></strong></span>
                                    <button type="button" class="btn btn-sm btn-outline-info" onclick="cancelReply()">
                                        Cancel Reply
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Comments List -->
                    <div class="comments-section">
                        <div id="comments-container">
                            @if($post->comments->count() > 0)
                                @foreach($post->comments as $comment)
                                    @include('frontend.comment', ['comment' => $comment])
                                @endforeach
                            @else
                                <div class="text-center py-4">
                                    <i class="far fa-comments fa-2x text-muted mb-3"></i>
                                    <p class="text-muted">No comments yet. Be the first to comment!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .comment-reply {
        margin-left: 2.5rem;
        padding-left: 1.5rem;
        border-left: 3px solid #e9ecef;
    }
    
    .reply-btn {
        font-size: 0.875rem;
        padding: 0.25rem 0.75rem;
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // AJAX comment submission
        $('#commentForm').on('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = $('#submitBtn');
            const submitText = $('#submitText');
            const loadingSpinner = $('#loadingSpinner');
            
            // Show loading state
            submitBtn.prop('disabled', true);
            submitText.addClass('d-none');
            loadingSpinner.removeClass('d-none');
            
            // Clear previous errors
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');
            
            const formData = $(this).serialize();
            
            $.ajax({
                url: '{{ route("frontend.comment") }}',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Reset form
                        $('#commentForm')[0].reset();
                        $('#parent_id').val('');
                        
                        // Hide reply indicator if active
                        if ($('#replyingTo').is(':visible')) {
                            $('#replyingTo').addClass('d-none');
                        }
                        
                        // Update comment count
                        const currentCount = parseInt($('#comment-count').text());
                        $('#comment-count').text(currentCount + 1);
                        
                        // Add new comment to the list
                        if (response.parent_id) {
                            // This is a reply
                            const $parentComment = $(`[data-id="${response.parent_id}"]`);
                            let $replySection = $parentComment.find('.comment-replies');
                            
                            if ($replySection.length === 0) {
                                $parentComment.append('<div class="comment-replies mt-3"></div>');
                                $replySection = $parentComment.find('.comment-replies');
                            }
                            
                            $replySection.append(response.comment);
                        } else {
                            // This is a top-level comment
                            if ($('#comments-container').find('.text-center').length) {
                                $('#comments-container').html('');
                            }
                            
                            $('#comments-container').prepend(response.comment);
                        }
                        
                        // Show success message
                        showAlert('Comment posted successfully!', 'success');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        // Validation errors
                        const errors = xhr.responseJSON.errors;
                        
                        Object.keys(errors).forEach(function(key) {
                            const input = $(`#${key}`);
                            const errorDiv = $(`#${key}-error`);
                            
                            input.addClass('is-invalid');
                            errorDiv.text(errors[key][0]);
                        });
                    } else {
                        showAlert('Something went wrong. Please try again.', 'danger');
                    }
                },
                complete: function() {
                    // Reset button state
                    submitBtn.prop('disabled', false);
                    submitText.removeClass('d-none');
                    loadingSpinner.addClass('d-none');
                }
            });
        });
        
        // Reply button click handler
        $(document).on('click', '.reply-btn', function() {
            const commentId = $(this).data('id');
            const commenterName = $(this).data('name');
            
            $('#parent_id').val(commentId);
            $('#reply-to-name').text(commenterName);
            $('#replyingTo').removeClass('d-none');
            
            // Scroll to comment form
            $('html, body').animate({
                scrollTop: $('#commentForm').offset().top - 100
            }, 500);
            
            // Focus on comment textarea
            $('#content').focus();
        });
    });
    
    function cancelReply() {
        $('#parent_id').val('');
        $('#replyingTo').addClass('d-none');
        $('#content').focus();
    }
    
    function showAlert(message, type) {
        const alertDiv = $('<div>')
            .addClass(`alert alert-${type} alert-dismissible fade show`)
            .attr('role', 'alert')
            .html(`
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `);
        
        // Remove existing alerts
        $('.alert').not('.alert-info').remove();
        
        // Add new alert before the form
        $('#commentForm').before(alertDiv);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            alertDiv.alert('close');
        }, 5000);
    }
</script>
@endpush

