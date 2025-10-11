<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cards Pay - Telecaller Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>


<div class="sidebar-and-caller-container">
    
@extends('layout.app')

@section('title', 'Main Dashboard')

@section('content')

    <div class="dashboard-layout">
        <header class="header">
            <div class="header-title">
                <h1>Telecaller</h1>
            </div>
            <div class="header-user">
                <i class="fa-solid fa-bell"></i>
                <div class="user-profile">AD</div>
            </div>
        </header>
        
        <main class="main-content">
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="icon" style="background-color: var(--primary-color);"><i class="fa-solid fa-users"></i></div>
                    <div class="info">
                        <h3>My Leads</h3>
                        <p>152</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="icon" style="background-color: var(--warning);"><i class="fa-solid fa-calendar-day"></i></div>
                    <div class="info">
                        <h3>Today's Follow-ups</h3>
                        <p>28</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="icon" style="background-color: var(--success);"><i class="fa-solid fa-chart-line"></i></div>
                    <div class="info">
                        <h3>Conversion Rate</h3>
                        <p>12.5%</p>
                    </div>
                </div>
            </div>
            <div class="content-block">
                <h3>Today's Follow-up List</h3>
                <div class="data-table-wrapper">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Last Contact</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="#" class="action-link">Raj Kumar</a></td>
                                <td><a href="tel:09312123000" class="action-link">09312123000</a></td>
                                <td>2 days ago</td>
                                <td><span class="status-badge status-call">Call Today</span></td>
                            </tr>
                            <tr>
                                <td><a href="#" class="action-link">Anjali Sharma</a></td>
                                <td><a href="tel:9988776655" class="action-link">9988776655</a></td>
                                <td>1 day ago</td>
                                <td><span class="status-badge status-call">Call Today</span></td>
                            </tr>
                            <tr>
                                <td><a href="#" class="action-link">Vikram Singh</a></td>
                                <td><a href="tel:8877665544" class="action-link">8877665544</a></td>
                                <td>3 days ago</td>
                                <td><span class="status-badge status-waiting">No Answer</span></td>
                            </tr>
                            <tr>
                                <td><a href="#" class="action-link">Priya Mehta</a></td>
                                <td><a href="tel:7766554433" class="action-link">7766554433</a></td>
                                <td>Today</td>
                                <td><span class="status-badge status-call">Call Today</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
@endsection
</div>
</body>
</html>