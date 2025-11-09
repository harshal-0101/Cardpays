<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styleFile2.css') }}">
</head>
<body>

<div class="sidebar-and-payment-container">

   @extends('layout.app')
   @section('title', 'Main Dashboard')
   @section('content')
   
    <div class="container">
           <header class="nav-header">
               <div class="header-title">
                   <h1>Payment</h1>
               </div>
               <div class="header-user">
                   <i class="fa-solid fa-bell"></i>
                   <div class="user-profile">AD</div> 
               </div>
           </header>

        <div class="header">

            <div class="header-right">
                <div class="search-box">
                    <input type="text" placeholder="search">
                    <i class="fas fa-caret-down"></i>
                </div>
                <button class="refresh-button">
                    <i class="fas fa-sync-alt"></i> Refresh
                </button>
            </div>
        </div><br>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Number</th>
                        <th>Client</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Number</th>
                        <th>Year</th>
                        <th>Payment Mode</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>001</td>
                        <td>abc</td>
                        <td>50000</td>
                        <td>09-10-25</td>
                        <td>0000000000</td>
                        <td>2025</td>
                        <td>online</td>
                    </tr>
                    <!-- <tr>
                        <td colspan="8">
                            <div class="no-data">
                                <i class="fas fa-archive"></i>
                                <p>No data</p>
                            </div>
                        </td>
                    </tr> -->
                    </tbody>
            </table>
        </div>
    </div>
  @endsection
</div>  
</body>
</html>