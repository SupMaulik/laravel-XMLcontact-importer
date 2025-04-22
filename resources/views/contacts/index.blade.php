@extends('layouts.app')

@section('content')

    {{-- Page heading with action buttons --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>All Contacts</h3>
        <div>
            <a href="{{ route('contacts.create') }}" class="btn btn-primary me-2">Add Contact</a>
            <a href="{{ route('contacts.importForm') }}" class="btn btn-success">Import via XML</a>
        </div>
    </div>

    {{-- Display message if there are no contacts --}}
    @if($contacts->isEmpty())
        <p>No contacts found.</p>
    @else
        {{-- Display table of contacts --}}
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $contact)
                    <tr>
                        <td>{{ $contact->id }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td class="text-end">
                            <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            {{-- Form to delete contact --}}
                            <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete this contact?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Display pagination links --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $contacts->links('pagination::bootstrap-5') }}
        </div>
    @endif

@endsection
