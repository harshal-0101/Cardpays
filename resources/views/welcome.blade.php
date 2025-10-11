<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@extends('layout.app')

@section('title', 'Main Dashboard')

@section('content')
    <h1 class="text-3xl font-bold text-gray-700 mb-6">Welcome to Your CRM Dashboard!</h1>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <p class="text-sm font-medium text-gray-500">Total Leads</p>
            <p class="text-3xl font-bold text-gray-900 mt-1">1,200</p>
        </div>
        </div>
    
@endsection
</body>
</html>