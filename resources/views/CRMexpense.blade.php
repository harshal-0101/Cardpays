<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styleFile2.css') }}">
</head>
<body>

<div class="sidebar-and-Expense-container">

   @extends('layout.app')
   @section('title', 'Main Dashboard')
   @section('content')

    <div class="container">
    
        <header class="nav-header">
              <div class="header-title">
                  <h1>Expense List</h1>
              </div>
              <div class="header-user">
                  <i class="fa-solid fa-bell"></i>
                  <div class="user-profile">AD</div>
              </div>
        </header>
        <br>

        <div class="action-bar">
            <div class="search-group">
                <form action="{{ route('expense.search') }}" method="GET">
                    <input type="Search here" name="search" placeholder="search">
                    <button class="btn refresh" type="submit">
                        <i class="fas fa-search"></i> Search
                    </button>
                </form>
            </div>
            
            <button class="btn add-expense" id="openExpenseModalBtn">
                <i class="fas fa-plus"></i> Add New Expense
            </button>
        </div>

        <div class="expense-table">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Expense Category</th>
                        <th>Currency</th>
                        <th>Total</th>
                        <th>Description</th>
                        <th>Reference</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($eexpenses as $eexpense)    
                    <tr>
                        <td>{{ $eexpense->name }}</td>
                        <td>{{ $eexpense->expense_category }}</td>
                        <td>{{ $eexpense->currency }}</td>
                        <td>{{ $eexpense->total }}</td>
                        <td>{{ $eexpense->description }}</td>
                        <td>{{ $eexpense->reference }}</td>
                    </tr>
                    @endforeach
                    @if ($eexpenses->isEmpty())
                    <tr>
                     
                        <td colspan="6">
                            <div class="no-data" style="text-align: center; padding: 50px 0; color: #aaa;">
                                <i class="fas fa-archive" style="font-size: 3em; margin-bottom: 10px;"></i>
                                <p style="margin: 0; font-size: 1.1em;">No data</p>
                            </div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <div id="newExpenseModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="title-group">
                    <i class="fas fa-times close-btn" id="closeExpenseModalBtn"></i>
                    <h3>New Expense</h3>
                </div>
                
            </div>
            
            <form id="expenseForm" method="POST" action="{{ route('expense.store') }}">
                @csrf
                <div class="form-group">
                    <label class="required">Name (Vendor/Item)</label>
                    <input type="text" name="name" placeholder="">
                </div>
                
                <div class="form-group">
                    <label class="required">Expense Category</label>
                    <select name="expense_category">
                        <option value="">Select Category</option>
                        <option value="software">Software Subscriptions</option>
                        <option value="travel">Travel & Transport</option>
                        <option value="marketing">Marketing</option>
                        <option value="rent">Office Rent</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="required">Currency</label>
                    <select name="currency">
                        <option value="$"> $ (US Dollar)</option>
                        <option value="€"> € (Euro)</option>
                        <option value="₹"> ₹ (Indian Rupee)</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="required">Total Amount</label>
                    <input type="number" step="0.01" value="0.00" name="total" placeholder="">
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea rows="3" name="description" placeholder="Brief details about the expense"></textarea>
                </div>
                
                <div class="form-group">
                    <label>Reference / Receipt No.</label>
                    <input type="text" name="reference" placeholder="">
                </div>

                <button type="submit" class="submit-btn">
                    <i class="fas fa-save"></i> submit
                </button>
            </form>
        </div>
    </div>
    @endsection
</div>
    <script src="{{ asset('js/scriptFile2.js') }}"></script>
</body>
</html>