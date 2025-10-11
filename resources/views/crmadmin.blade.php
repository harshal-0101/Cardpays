<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cards Pay - Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

     <script src="{{ asset('js/script.js') }}"></script>

    <!-- <style>
        :root {
            --primary-color: #0052cc;
            --primary-light: #e6f0ff;
            --background-color: #f4f7fc;
            --card-background: #ffffff;
            --text-dark: #2c3e50;
            --text-light: #8a99b5;
            --border-color: #e6e9f0;
            --shadow-color: rgba(44, 62, 80, 0.1);
            --success: #28a745;
            --warning: #ffc107;
            --danger: #dc3545;
        }

        *, *::before, *::after {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            margin: 0;
            padding: 0;
            font-size: 16px;
        }

        .dashboard-layout {
            display: grid;
            grid-template-columns: 1fr; /* Single column layout */
            grid-template-rows: auto 1fr;
            height: 100vh;
            grid-template-areas:
                "header"
                "main";
        }

        /* --- Header --- */
        .header {
            grid-area: header;
            background-color: var(--card-background);
            padding: 1rem 2rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header-title h1 {
            margin: 0;
            font-size: 1.75rem;
            color: var(--text-dark);
        }
        .header-user {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .header-user i {
            font-size: 1.2rem;
            color: var(--text-light);
            cursor: pointer;
        }
        .user-profile {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        /* --- Main Content --- */
        .main-content {
            grid-area: main;
            overflow-y: auto;
            padding: 2rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background-color: var(--card-background);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 20px var(--shadow-color);
            display: flex;
            align-items: center;
            gap: 1.2rem;
        }

        .stat-card .icon {
            font-size: 2rem;
            padding: 15px;
            border-radius: 50%;
            color: #fff;
        }

        .stat-card .info h3 {
            margin: 0 0 5px;
            font-size: 1rem;
            color: var(--text-light);
            font-weight: 500;
        }

        .stat-card .info p {
            margin: 0;
            font-size: 2rem;
            font-weight: 700;
        }

        .content-block {
            background-color: var(--card-background);
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 20px var(--shadow-color);
            margin-bottom: 1.5rem;
        }

        .content-block h3 {
            margin-top: 0;
            margin-bottom: 1.5rem;
            font-size: 1.25rem;
            color: var(--text-dark);
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }
            .header {
                padding: 1rem;
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            .main-content {
                padding: 1rem;
            }
        }
    </style> -->
</head>
<body>

<div class="sidebar-and-lead-container">

@extends('layout.app')

@section('title', 'Main Dashboard')

@section('content')


  <div class="admin-continer-box">   
    <div class="dashboard-layout">
        <header class="header">
            <div class="header-title">
                <h1>Admin Dashboard</h1>
            </div>
            <div class="header-user">
                <i class="fa-solid fa-bell"></i>
                <div class="user-profile">AD</div>
            </div>
        </header>
        
        <main class="main-content">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="icon" style="background-color: var(--danger);"><i class="fa-solid fa-globe"></i></div>
                    <div class="info">
                        <h3>Total Leads</h3>
                        <p>10,840</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="icon" style="background-color: var(--success);"><i class="fa-solid fa-handshake-simple"></i></div>
                    <div class="info">
                        <h3>Total Conversions</h3>
                        <p>1,253</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="icon" style="background-color: var(--text-dark);"><i class="fa-solid fa-dollar-sign"></i></div>
                    <div class="info">
                        <h3>Total Transactions</h3>
                        <p>$89,210</p>
                    </div>
                </div>
            </div>
            <div class="content-block">
                <h3>System Activity (Leads vs Conversions)</h3>
                <canvas id="systemActivityChart" height="120"></canvas>
            </div>
        </main>
    </div>
 </div>
 @endsection
</div>
    
</body>
</html>