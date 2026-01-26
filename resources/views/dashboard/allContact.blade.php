@extends('dashboard.layout.app')
@section('title','Contact List')

@section('content')

<main class="app-main">

  <!-- Content Header -->
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Contact Messages</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Contacts</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="app-content">
    <div class="container-fluid">

      <div class="card">
        <div class="card-body table-responsive">

          <table class="table table-bordered table-striped align-middle">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Message</th>
                <th>Sent At</th>
              </tr>
            </thead>

            <tbody>
              @forelse($Contacts as $contact)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $contact->name }}</td>
                  <td>{{ $contact->phone }}</td>
                  <td>{{ $contact->email }}</td>
                  <td style="max-width: 300px;">
                    {{ Str::limit($contact->message, 80) }}
                  </td>
                  <td>{{ $contact->created_at->format('d M Y') }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center text-muted">
                    No contact messages found
                  </td>
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
