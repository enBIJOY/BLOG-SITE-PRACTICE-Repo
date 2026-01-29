@extends('dashboard.layout.app')

@section('title')
    {{ config('app.name') }} | General Settings
@endsection

{{-- Active Menu --}}
@section('generalSettings')
    active
@endsection


{{-- Breadcrumb --}}
@section('breadcrumb')
     <h2 class="content-header-title float-left mb-0">Admin Dashboard</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">
                Gerneral Settings
            </li>
        </ol>
    </div>
@endsection

{{-- Page Content --}}
@section('content')
    <section id="basic-vertical-layouts">
        <div class="row">
            <div class="col-md-7 col-12 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">General Settings</h4>
                        @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('warning'))
                            <div class="alert alert-warning">{{ session('warning') }}</div>
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
                                <label class="form-label">Address</label>
                                <input type="text" value="{{ $generalSettings->address }}" placeholder="You Address" name="address" class="form-control">
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
                            <!-- <input type="text" name="address" value="{{ $generalSettings->address }}" placeholder="Address">

                            <input type="file" name="logo">
                            <input type="file" name="favicon">

                            <input type="text" name="meta_title" value="{{ $generalSettings->meta_title }}">
                            <input type="text" name="meta_description" value="{{ $generalSettings->meta_description }}">
                            <input type="text" name="meta_keywords" value="{{ $generalSettings->meta_keywords }}">
                            <input type="text" name="year" value="{{ $generalSettings->year }}"> -->

                            <button type="submit">Save</button>
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
