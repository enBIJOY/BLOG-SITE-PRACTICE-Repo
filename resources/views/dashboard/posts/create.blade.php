@extends('dashboard.layout.app')

@section('title', 'Create New Post')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0">Create New Blog Post</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-8">
                                <!-- Title -->
                                <div class="mb-3">
                                    <label for="title" class="form-label">Post Title *</label>
                                    <input type="text" 
                                           class="form-control @error('title') is-invalid @enderror" 
                                           id="title" 
                                           name="title" 
                                           value="{{ old('title') }}" 
                                           required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Subtitle -->
                                <div class="mb-3">
                                    <label for="subtitle" class="form-label">Subtitle (Optional)</label>
                                    <input type="text" 
                                           class="form-control @error('subtitle') is-invalid @enderror" 
                                           id="subtitle" 
                                           name="subtitle" 
                                           value="{{ old('subtitle') }}">
                                    @error('subtitle')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Content -->
                                <div class="mb-3">
                                    <label for="content" class="form-label">Content *</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" 
                                              id="content" 
                                              name="content" 
                                              rows="12" 
                                              required>{{ old('content') }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <!-- Image Upload -->
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h6 class="mb-0">Featured Image</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <input type="file" 
                                                   class="form-control @error('image') is-invalid @enderror" 
                                                   id="image" 
                                                   name="image"
                                                   accept="image/*">
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">
                                                Upload JPG, PNG, or GIF (Max: 2MB)
                                            </div>
                                        </div>
                                        
                                        <!-- Image Preview -->
                                        <div id="imagePreview" class="text-center d-none">
                                            <img id="previewImage" 
                                                 src="#" 
                                                 alt="Image Preview" 
                                                 class="img-fluid rounded mb-2"
                                                 style="max-height: 200px;">
                                            <p class="text-muted small">Preview</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Publish Status -->
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h6 class="mb-0">Publish Settings</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" 
                                                   type="checkbox" 
                                                   id="published" 
                                                   name="published" 
                                                   value="1"
                                                   {{ old('published', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="published">
                                                Publish this post
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Submit Buttons -->
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Create Post
                                    </button>
                                    <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times me-1"></i> Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Image preview
    document.getElementById('image').addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        const previewImage = document.getElementById('previewImage');
        const file = e.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                preview.classList.remove('d-none');
            }
            
            reader.readAsDataURL(file);
        } else {
            preview.classList.add('d-none');
        }
    });
</script>
@endpush