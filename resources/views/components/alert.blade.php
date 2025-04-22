{{-- Display success message from session --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Display validation errors --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>There were some errors:</strong>
        <ul class="mb-0 mt-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
