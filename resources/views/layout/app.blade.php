<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRM Dashboard - @yield('title')</title>
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
</head>
<body>
    <div id="app" class="flex h-screen bg-gray-100" style="display: flex; height: 100vh; background-color: #f4f7fc;">
        
        <x-sidebar/>
        
        <div class="flex-1 flex flex-col overflow-hidden">
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 p-6">
                @yield('content')
            </main>
            
        </div>
    </div>
    
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
</body>
</html>