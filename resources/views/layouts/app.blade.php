<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    {{-- Dynamic app title from config --}}
    <title>{{ config('app.name', 'Contact Manager') }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{--  Material Design Bootstrap (MDB) UI Kit --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet" />

    {{--Google Material Icons --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

 
</head>
<body>

    {{-- App Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('contacts.index') }}">
                 Contact Manager
            </a>
        </div>
    </nav>

    {{-- Main content section --}}
    <main class="container">

        {{-- Global flash message component (Blade component) --}}
        <x-alert />

        {{-- Page-specific content injected here --}}
        @yield('content')

    </main>

    {{--  MDB JavaScript for UI interactions --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>

   
</body>
</html>
