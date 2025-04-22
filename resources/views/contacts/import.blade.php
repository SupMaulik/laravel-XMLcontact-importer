@extends('layouts.app')

@section('content')

    {{-- Page title --}}
    <h3 class="mb-4">Import Contacts from XML</h3>

    {{-- Form to upload XML file --}}
    <form action="{{ route('contacts.import') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- File input field for XML file --}}
        <div class="form-outline mb-4">
            <input type="file" name="xml_file" class="form-control" accept=".xml" required />
            <label class="form-label">Choose XML File</label>
        </div>

        {{-- Submit and back buttons --}}
        <button type="submit" class="btn btn-success">Start Import</button>
        <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Back</a>
    </form>

@endsection
