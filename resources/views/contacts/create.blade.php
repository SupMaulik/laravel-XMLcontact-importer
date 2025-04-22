@extends('layouts.app')

@section('content')

    {{-- Page title --}}
    <h3 class="mb-4">Add New Contact</h3>

    {{-- Form to create a new contact --}}
    <form action="{{ route('contacts.store') }}" method="POST">
        @csrf

        {{-- Input for contact name --}}
        <div class="form-outline mb-4">
            <input type="text" id="name" name="name" class="form-control" required />
            <label class="form-label" for="name">Full Name</label>
        </div>

        {{-- Input for contact phone number --}}
        <div class="form-outline mb-4">
            <input type="text" id="phone" name="phone" class="form-control" required />
            <label class="form-label" for="phone">Phone Number</label>
        </div>

        {{-- Submit and back buttons --}}
        <button type="submit" class="btn btn-primary">Save Contact</button>
        <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Back</a>
    </form>

@endsection
