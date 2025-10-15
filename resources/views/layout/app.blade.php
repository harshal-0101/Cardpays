<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRM Dashboard - @yield('title')</title>
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
</head>
<style>

/* .toast-message {
    padding: 10px 20px;
    margin-bottom: 10px;
    border-radius: 5px;
    color: white;
    font-weight: bold;
    opacity: 0; /* Start hidden */
    transform: translateY(-20px); /* Start slightly above */
    transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
}

.toast-success {
    background-color: #28a745; /* Green */
}

.toast-error {
    background-color: #dc3545; /* Red */
}

.toast-show {
    opacity: 1;
    transform: translateY(0);
} */
</style>
<body>

    <div id="app" class="flex h-screen bg-gray-100" style="display: flex; height: 100vh; background-color: #f4f7fc;">
        
        <x-sidebar/>
        
        <div class="flex-1 flex flex-col overflow-hidden">
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 p-6">
                @yield('content')
            </main>
            
        </div>
    </div>
    
</body>
</html>

