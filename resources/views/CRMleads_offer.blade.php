<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotes For Leads</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styleFile2.css') }}">
</head>
<body>

<div class="sidebar-and-lead-offer-container">

   @extends('layout.app')
   @section('title', 'Main Dashboard')
   @section('content')

    <div class="container">

        <header class="nav-header">
              <div class="header-title">
                  <h1>Offers For Leads</h1>
              </div>
              <div class="header-user">
                  <i class="fa-solid fa-bell"></i>
                  <div class="user-profile">AD</div>
              </div>
        </header>

        <br>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- Error Message --}}
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

{{-- Validation Errors --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <div class="action-bar">
            <div class="search-group">
                <input type="text" placeholder="search">
            </div>
            <button class="btn refresh">
                <i class="fas fa-sync-alt"></i> Refresh
            </button>
            <button class="btn add-quote" id="openModalBtn">
                <i class="fas fa-plus"></i> Add New Quote (for Lead)
            </button>
        </div>

        <div class="quote-table">
            <table>
                <thead>
                    <tr>
                        <th>Lead Id</th>
                        <th>Offer Title</th>
                        <th>Offer Description</th>
                        <th>Date</th>
                        <th>Expire Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($offers as $offer)
                    <tr>
                        <td>{{ $offer->lead_id }}</td>
                        <td>{{ $offer->title }}</td>
                        <td>{{ $offer->description }}</td>
                        <td>{{ $offer->created_at }}</td>
                        <td>{{ $offer->expire_date }}</td>
                        <td><span class="status-badge status-sent">Sent</span></td>
                    </tr>
                    @endforeach
                    
                    @if($offers->isEmpty())
                    <tr>
                        <td colspan="6" style="text-align: center;">No offers found.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <div id="newInvoiceModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="title-group">
                    <i class="fas fa-arrow-left"></i>
                    <h3>New</h3>
                    <div class="draft-status">Draft</div>
                </div>
                <div class="action-buttons">
                    <button class="btn cancel-btn" id="closeModalBtn">
                        <i class="fas fa-times-circle"></i> Cancel
                    </button>
                    <button class="btn save-btn">
                        <i class="fas fa-save"></i> Save
                    </button>
                </div>
            </div>

            <!-- <form id="quoteForm"> -->
                <!-- <div class="form-grid">
                    <div class="form-group span-2">
                        <label>Lead Id</label>
                        <input type="text" placeholder="Lead Id" >
                    </div>
                    <div class="form-group">
                        <label>* Number</label>
                        <input type="number" value="1" readonly>
                    </div>
                    <div class="form-group">
                        <label>* Year</label>
                        <input type="number" value="2025" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>* Currency</label>
                        <select>
                            <option>$ (US Dollar)</option>
                            <option>€ (Euro)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select>
                            <option>Draft</option>
                            <option>Sent</option>
                            <option>Accepted</option>
                            <option>Rejected</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>* Date</label>
                        <div class="input-with-icon">
                            <input type="date" value="2025-11-01">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>* Expire Date</label>
                        <div class="input-with-icon">
                            <input type="date" value="2025-12-01">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>
                    <div class="form-group span-2">
                        <label>Note</label>
                        <input type="text">
                    </div>
                </div> -->

                <div class="item-list-container">
                    <!-- <div class="item-list-header">
                        
                        <div>Item</div>
                        <div>Description</div>
                        <div>Lead Id</div>
                        <div>Date</div>
                        <div>Expire Date</div>
                        <div>Status</div>
                    </div> -->

                    <div id="itemRowsContainer">
                        <div class="item-row item-template">
                           <form action="{{ route('leadOffer.store') }}" method="POST"> 
                            @csrf
                            <label for="title">title</label>
                            <input type="text" placeholder="title" name="title"><br>
                            <label for="description">Description</label>
                            <input type="text" placeholder="description Name" name="description"><br>
                            <label for="lead_id">Lead ID</label>
                            <input type="number" value="1" min="0" name="lead_id"><br>
                            <label for="date">Date</label>
                            <input type="date" value="2025-11-01" name="date"><br>
                            <label for="expire_date">Expire Date</label>
                            <input type="date" value="2025-12-01" name="expire_date"><br>
                            <label for="status">Status</label>
                            <select class="offer-status" name="status">
                                <option>Draft</option>
                                <option>Sent</option>
                                <option>Accepted</option>
                                <option>Rejected</option>
                            </select>

                            <button type="submit" class="save-button-bottom">
                            <i class="fas fa-save"></i> Save
                           </button>
                           </form> 
                            <!-- <i class="fas fa-trash-alt delete-icon" onclick="deleteItemRow(this)"></i> -->
                        </div>
                    </div>
                </div>

                <!-- <button type="button" class="add-field-btn" onclick="addItemRow()">
                    <i class="fas fa-plus"></i> Add Field
                </button> -->

                <div class="totals-section">
                    
                    <!-- <div class="totals-box">
                        <div class="total-row">
                            <label>Sub Total</label>
                            <div class="price-input-group">
                                <span>$ </span>
                                <input type="text" value="00.00" readonly>
                            </div>
                        </div>
                        <div class="total-row">
                            <input type="number" placeholder="Select Tax Value" style="width: 130px;">
                            <div class="price-input-group">
                                <span>$ </span>
                                <input type="text" value="00.00">
                            </div>
                        </div>
                        <div class="total-row" style="border-top: 1px solid #eee; padding-top: 10px;">
                            <strong>Total:</strong>
                            <div class="price-input-group" style="border: none;">
                                <strong>$</strong>
                                <input type="text" value="00.00">
                            </div>
                        </div>
                    </div> -->
                </div>
            <!-- </form> -->
        </div>
    </div>
   @endsection
</div>    
    <script src="{{ asset('js/scriptFile2.js') }}"></script>
</body>
</html>