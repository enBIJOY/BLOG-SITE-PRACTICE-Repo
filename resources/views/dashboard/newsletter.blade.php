@extends('dashboard.layout.app')
@section('title','Subscribers')

@section('content')

<main class="app-main">
    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <h3 class="mb-0">Newsletter Subscribers</h3>
        </div>
    </div>
    <!-- Content -->
    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <!-- <th>Name</th> -->
                                <th>Email</th>
                                <th>Subscribed At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($newsletters as $newsletter)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <!-- <td>{{ $newsletter->name }}</td> -->
                                    <td>{{ $newsletter->email }}</td>
                                    <td>{{ $newsletter->created_at->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No subscribers found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
