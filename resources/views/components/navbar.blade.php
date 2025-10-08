<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel Navbar</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

        /* body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f6;
        } */
        .admin-navbar {
            font-family: 'Poppins', sans-serif;
            background-color: #2c3e50;
            /* padding: 1rem 1.5rem; */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-bottom: 2px solid #3498db;
        }

        .admin-navbar .navbar-brand {
            color: #ecf0f1; 
            font-weight: 600;
            font-size: 1.5rem;
        }
        
        .admin-navbar .navbar-brand i {
            /* margin-right: 10px; */
            color: #3498db; 
        }

        .admin-navbar .navbar-brand:hover {
            color: #ffffff;
        }

    
        .btn-lead {
            background-color: #3498db; 
            border: none;
            color: #ffffff;
            font-weight: 500;
            padding: 0.5rem 1.5rem;
            border-radius: 50px; 
            transition: all 0.3s ease;
        }

        .btn-lead:hover {
            background-color: #2980b9; 
            transform: translateY(-2px); 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
   
        
        /* .admin-navbar .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.2);
        } */

        .admin-navbar .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28236, 240, 241, 0.8%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
        
        /* Added margin for the nav-item on larger screens for better spacing */
        .navbar-nav .nav-item {
             margin-left: 1rem;
        }
        
        @media (max-width: 991.98px) {
            .admin-navbar .navbar-nav {
                margin-top: 1rem; 
            }
            /* Reset margin for mobile view */
            .navbar-nav .nav-item {
                 margin-left: 0;
            }
            .btn-lead {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg admin-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                Cards Pay
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbarContent" aria-controls="adminNavbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="adminNavbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <button class="btn btn-lead" type="button">Lead</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>