@extends('dashboard.layout.app')

@section('title')
    {{ config('app.name') }} | General Settings
@endsection

{{-- Active Menu --}}
@section('generalSettings')
    active
@endsection


{{-- Page Content --}}
@section('content')
<h2 class="text-center mt-2">General Settings</h2>
    <section id="basic-vertical-layouts">
        <div class="row">
            <div class="col-md-7 col-12 m-auto">
                <div class="card">
                    <div>
                        <!-- <h5 class="card-title text-center">General Settings</h5> -->
                        @if (session('success'))
                        <x-alert type="success" timeout="5000">
                            Settings updated successfully
                        </x-alert>
                        <!-- <div class="alert alert-success">{{ session('success') }}</div> -->
                        @endif
                        @if (session('warning'))
                        <x-alert type="warning" timeout="5000">
                            Something Went Wrong
                        </x-alert>
                            <!-- <div class="alert alert-warning">{{ session('warning') }}</div> -->
                        @endif
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ route('generalSettings.update', $generalSettings->id) }}"
                            method="POST"
                            enctype="multipart/form-data"
                        >
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" value="{{ $generalSettings->phone }}" placeholder="+8800000000000" name="phone" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone 2</label>
                                <input type="text" value="{{ $generalSettings->phone2 }}" placeholder="+8800000000000" name="phone2" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" value="{{ $generalSettings->address }}" placeholder="Your Address" name="address" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address 2</label>
                                <input type="text" value="{{ $generalSettings->address2 }}" placeholder="Your Address" name="address2" class="form-control">
                            </div>
                                {{-- CURRENT LOGO --}}
                            <div class="mb-3">
                                <label class="form-label">Current Logo</label><br>

                                @if($generalSettings->logo)
                                    <img src="{{ asset('uploads/general/'.$generalSettings->logo) }}"
                                        alt="Logo"
                                        style="height:80px; border:1px solid #ddd; padding:5px">
                                @else
                                    <p class="text-muted">No logo uploaded</p>
                                @endif
                            </div>

                                {{-- CHANGE LOGO --}}
                            <div class="mb-3">
                                <label class="form-label">Change Logo</label>
                                <input type="file" name="logo" class="form-control" onchange="previewLogo(this)">
                                <img id="logoPreview" style="height:80px; display:none; margin-top:10px;">
                            </div>
                                {{-- CURRENT FAVICON --}}
                            <div class="mb-3">
                                <label class="form-label">Current Favicon</label><br>

                                @if($generalSettings->favicon)
                                    <img src="{{ asset('uploads/general/'.$generalSettings->favicon) }}"
                                        alt="Favicon"
                                        style="height:40px; border:1px solid #ddd; padding:5px">
                                @else
                                    <p class="text-muted">No favicon uploaded</p>
                                @endif
                            </div>

                                {{-- CHANGE FAVICON --}}
                            <div class="mb-3">
                                <label class="form-label">Change Favicon</label>
                                <input type="file" name="favicon" class="form-control" onchange="previewFavicon(this)">
                                <img id="faviconPreview" style="height:40px; display:none; margin-top:10px;">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Meta Title</label>
                                <input type="text" value="{{ $generalSettings->meta_title }}" placeholder="Your Title Here" name="meta_title" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Meta Description</label>
                                <input type="text" value="{{ $generalSettings->meta_description }}" placeholder="Your Description" name="meta_description" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Meta Keywords</label>
                                <input type="text" value="{{ $generalSettings->meta_keywords }}" placeholder="Your Keyword" name="meta_keywords" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">year</label>
                                <input type="text" value="{{ $generalSettings->year }}" placeholder="Change Year" name="year" class="form-control">
                            </div>
                            <x-button variant="primary" onclick="return confirm('Sure?')">Save</x-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scriptjs')
<script>
    function previewLogo(input) {
        if (input.files && input.files[0]) {
            document.getElementById('logoPreview').src =
                URL.createObjectURL(input.files[0]);
            document.getElementById('logoPreview').style.display = 'block';
        }
    }

    function previewFavicon(input) {
        if (input.files && input.files[0]) {
            document.getElementById('faviconPreview').src =
                URL.createObjectURL(input.files[0]);
            document.getElementById('faviconPreview').style.display = 'block';
        }
    }
</script>
@endpush
