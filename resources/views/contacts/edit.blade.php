@extends('layouts.app')

@section('content')

    {{-- Page title --}}
    <h3 class="mb-4">Edit Contact</h3>

    {{-- Form to update an existing contact --}}
    <form action="{{ route('contacts.update', $contact) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Input for contact name --}}
        <div class="form-outline mb-4">
            <input type="text" id="name" name="name" class="form-control" value="{{ $contact->name }}" required />
            <label class="form-label" for="name">Full Name</label>
        </div>

        {{-- Input for contact phone number --}}
        <div class="form-outline mb-4">
            <input type="text" id="phone" name="phone" class="form-control" value="{{ $contact->phone }}" required />
            <label class="form-label" for="phone">Phone Number</label>
        </div>

        {{-- Submit and back buttons --}}
        <button type="submit" class="btn btn-warning">Update Contact</button>
        <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Back</a>
    </form>

@endsection
