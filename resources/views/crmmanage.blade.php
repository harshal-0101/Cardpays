<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cards Pay - Manager Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="sidebar-and-manager-container">
    
@extends('layout.app')

@section('title', 'Main Dashboard')

@section('content')

    <div class="dashboard-layout">
        <header class="header">
            <div class="header-title">
                <h1>Manager Dashboard</h1>
            </div>
            <div class="header-user">
                <i class="fa-solid fa-bell"></i>
                <div class="user-profile">AD</div>
            </div>
        </header>
        
        <main class="main-content">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="icon" style="background-color: #6f42c1;"><i class="fa-solid fa-users-gear"></i></div>
                    <div class="info">
                        <h3>Team Performance</h3>
                        <p>85%</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="icon" style="background-color: #fd7e14;"><i class="fa-solid fa-list-check"></i></div>
                    <div class="info">
                        <h3>Active Leads</h3>
                        <p>475</p>
                    </div>
                </div>
            </div>
            <div class="content-block chart-container-small">
                <h3>Leads Status Overview</h3>
                <canvas id="leadsStatusChart"></canvas>
            </div>
        </main>
    </div>
@endsection
</div>

    <script src="{{ asset('js/script.js') }}"></script>

</body>
</html>