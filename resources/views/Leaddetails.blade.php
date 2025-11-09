<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM Overview</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
 <link rel="stylesheet" href="{{ asset('css/style.css') }}">
<script src="{{ asset('js/script.js') }}"></script>
</head>

<body>
 <div class="sidebar-and-lead-container">

@extends('layout.app')

@section('title', 'Main Dashboard')

@section('content')

    <div class="container-lead-details">
        <div class="header-tabs">
            <button data-tab="overview" class="active"><i class="fa fa-info-circle" aria-hidden="true"></i> Overview</button>
            <button data-tab="follow-up"><i class="fa fa-lightbulb-o"></i> Follow Up</button>
            <button data-tab="card-details"><i class="fa fa-id-card-o" aria-hidden="true"></i> Card Details</button>
            <button data-tab="history"><i class="fa fa-history" aria-hidden="true"></i> History</button>
            <button data-tab="transaction"><i class="fa fa-eur" aria-hidden="true"></i> Transaction History</button>
            <button data-tab="attachment"><i class="fa fa-link" aria-hidden="true"></i> Attachment</button>
            <button data-tab="lead-transaction"><i class="fa fa-eur" aria-hidden="true"></i> Transaction</button>
            <div class="header-right-actions" style="display: flex;"> <button class="edit-btn" id="openEditModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                    Edit
                </button>
                <button class="update-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-ccw"><polyline points="1 4 1 10 7 10"></polyline><polyline points="23 20 23 14 17 14"></polyline><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path></svg>
                    Update record
                </button>
            </div>
        </div>


@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Validation Error:</strong>
        <ul style="margin: 0; padding-left: 20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

        <div class="content-area">
            <div id="overview" class="tab-content active">
                <div class="grid-container">
                    <div class="grid-item">
                        <label>Name:</label>
                        <p id="overview-name-value">{{ $lead->Name }}</p>
                    </div>
                    <div class="grid-item">
                        <label>Mobile:</label>
                        <p id="overview-mobile-value">{{ $lead->Mobile }}</p>
                    </div>
                    <div class="grid-item">
                        <label>City:</label>
                        <p id="overview-city-value"><span class="badge">{{ $lead->City }}</span></p>
                    </div>
                    <div class="grid-item">
                        <label>Cards:</label>
                        <p id="overview-cards-value">{{ $lead->Cards }}</p>
                    </div>
                    <div class="grid-item">
                        <label>Total Bill:</label>
                        <p id="overview-totalbill-value">Rs. {{ number_format($lead->Total_Bill) }}</p>
                    </div>
                    <div class="grid-item">
                        <label>Stage:</label>
                        <p id="overview-stage-value"><span class="badge">{{ $lead->Stage }}</span></p>
                    </div>
                    <div class="grid-item">
                        <label>Source:</label>
                        <p id="overview-source-value"><span class="badge">{{ $lead->Source }}</span></p>
                    </div>
                    <div class="grid-item">
                        <label>Owner:</label>
                        <p id="overview-owner-value">{{ $lead->Owner }}</p>
                    </div>
                </div>
            </div>

            <div id="card-details" class="tab-content">

                <!-- <div class="card-details-header">
                    <button class="add-new-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Add new
                    </button>
                    <button class="custom-request-btn custom-request-btn-style">Custom request</button>
                </div> -->
                

                <div class="card-details-table-wrapper">
                    <table class="card-details-table">
                        <thead>
                            <tr>

                                <th>Bank Name</th>
                                <th>Bill Amount</th>
                                <th>Due Date</th>
                                <th>Card Type</th>
                                <th>Card Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                              @foreach ($lead->cards as $card)
                            <tr>
                                 <td><span class="bank-badge">{{ $card->bank_name }}</span></td>
                                <td>{{ number_format($card->bill_amount) }}</td>
                                <td>{{ \Carbon\Carbon::parse($card->due_date)->format('d/m/Y') }}</td>
                                 <td>{{ $card->card_type }}</td>
                                <td><span class="status-badge {{ $card->card_status == 'Active' ? 'status-active' : 'status-blocked' }}">{{ $card->card_status }}</span></td>
                                 <td><form action="{{ route('cards.destroy', $card->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this card?');">
                                     @csrf
                                     @method('DELETE')
                                     <button type="submit" class="btn btn-danger btn-sm" title="Delete Card">
                                         <i class="fa-solid fa-trash"></i>
                                     </button>
                                 </form>
                                 </td>
                            </tr>
                            @endforeach

                            @if($lead->cards->isEmpty())
                                <tr>
                                    <td colspan="6" style="text-align: center; padding: 20px;">No card details available.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- <div class="table-footer">
                    <span>Total 7 items</span>
                    <div class="pagination-controls"><button>&lt;</button><button class="active">1</button><button>&gt;</button></div>
                    <select class="page-size-select"><option>20 / page</option></select>
                </div><br> -->

                <div class="add-card-form">
    <form action="{{ route('cards.store') }}" method="POST" id="addCardForm">
        @csrf
      <input type="hidden" name="lead_id" value="{{ $lead->id }}">
        <div class="form-group">
            <!-- <label for="bank-name-select">Bank Name:</label> -->
            <select id="bank-name-select" name="bank_name">
                <option value="" disabled selected>Select Bank</option>
                <option value="ICICI">ICICI</option>
                <option value="HDFC">HDFC</option>
                </select>
        </div>
        <div class="form-group">
            <!-- <label for="bill-amount-input">Bill Amount:</label> -->
            <input type="number" id="bill-amount-input" name="bill_amount" placeholder="Bill Amount">
        </div>
        <div class="form-group input-with-icon">
            <!-- <label for="due-date-input">Due Date:</label> -->
            <input type="date" id="due-date-input" name="due_date" placeholder="Select date">
            <span class="date-icon">-</span>
        </div>
        <div class="form-group">
            <!-- <label for="card-type-select">Card Type:</label> -->
            <select id="card-type-select" name="card_type">
                <option value="Visa" selected>Visa</option>
                <option value="MasterCard">MasterCard</option>
                <option value="Diners">Diners</option>
            </select>
        </div>
        <div class="form-group">
            <!-- <label for="card-status-select">Card Status:</label> -->
            <select id="card-status-select" name="card_status">
                <option value="Active" selected>Active</option>
                <option value="Blocked">Blocked/Settled</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="add-card-btn">Add Card</button>
        </div>
    </form>
    </div>

            </div>

            <div id="transaction" class="tab-content">
                <div class="transaction-card">
                    <label for="transaction-select">transaction :</label>
                    <select id="transaction-select">
                        <option value="" disabled selected></option>
                        <option value="last_30">Last 30 Days</option>
                        <option value="last_90">Last 90 Days</option>
                        <option value="all">All Transactions</option>
                    </select>


                    <div id="mainTableContainer" class="transaction-table-block">
                        <div class="table-header-controls">
                            <h2 class="table-title">Transaction Set</h2>
                        </div>
                        <div class="table-responsive">
                            <table class="tratable">
                                <thead>
                                    <tr>
                                        <th>Service</th>
                                        <th>Bank</th>
                                        <th>Card Type</th>
                                        <th>Charge %</th>
                                        <th>Swip Amount</th>
                                        <th>Swipe Mode</th>
                                        <th>Payment</th>
                                        <th>Pay Mode</th>
                                        <th>Charge Amount</th>
                                        <th>Short</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lead->transactions as $txn)
                                    <tr>
                                        <td>{{ $txn->Service }}</td>
                                        <td>{{ $txn->Bank }}</td>
                                        <td>{{ $txn->Card_Type }}</td>
                                        <td>{{ $txn->Charge }}%</td>
                                        <td>₹{{ number_format($txn->Swipe_Amt) }}</td>
                                        <td>{{ $txn->Swipe_Mode }}</td>
                                        <td>₹{{ number_format($txn->Payment) }}</td>
                                        <td>{{ $txn->Pay_Mode }}</td>
                                        <td>₹{{ number_format($txn->Charge_Amt) }}</td>
                                        <td>₹{{ number_format($txn->Short) }}</td>
                                    </tr>
                                    @endforeach

                                    @if($lead->transactions->isEmpty())
                                        <tr>
                                            <td colspan="10" style="text-align: center; padding: 20px;">No transactions available.</td>
                                        </tr>
                                        @endif
                                </tbody>
                                
                            </table>
                        </div>
                    </div>

                </div>
            </div>

            <div id="follow-up" class="tab-content">
                <div class="follow-up-container">

                    <div class="follow-up-form-card">
                        <form id="followUpForm">
                            <div class="follow-up-form-grid">

                                <div class="form-group">
                                    <label for="fu-type-select">Follow Up Type:</label>
                                    <select id="fu-type-select">
                                        <option value="Call">Call</option>
                                        <option value="Email">Email</option>
                                        <option value="Meeting">Meeting</option>
                                        <option value="Task">Internal Task</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="fu-status-select">Current Status:</label>
                                    <select id="fu-status-select">
                                        <option value="Pending">Pending</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="fu-date-input">Follow Up Date:</label>
                                    <input type="date" id="fu-date-input" value="2025-10-15">
                                </div>

                                <div class="form-group">
                                    <label for="fu-owner-select">Assigned To:</label>
                                    <select id="fu-owner-select">
                                        <option value="Pawan shinde">Pawan shinde</option>
                                        <option value="Bhoomika">Bhoomika</option>
                                    </select>
                                </div>

                                <div class="form-group full-width">
                                    <label for="fu-notes-textarea">Notes/Description:</label>
                                    <textarea id="fu-notes-textarea" placeholder="Enter follow up details..."></textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="submit-btn">
                                        <i class="fa fa-plus-circle"></i> Add Follow Up
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="follow-up-history-card">
                        <h3>Follow Up History (Recent)</h3>
                        <div class="table-responsive">
                            <table class="follow-up-history-table">
                                
                                </thead>
                                <tbody id="followUpTableBody">
                                    <tr data-status="Completed">
                                        <td>2025-10-01</td>
                                        <td>Call</td>
                                        <td>Discussed card details, customer deferred for 1 week.</td>
                                        <td>Pawan shinde</td>
                                        <td><span class="status-completed">Completed</span></td>
                                    </tr>
                                    <tr data-status="Pending">
                                        <td>2025-10-15</td>
                                        <td>Email</td>
                                        <td>Send reminder about pending documents.</td>
                                        <td>Bhoomika</td>
                                        <td><span class="status-pending">Pending</span></td>
                                    </tr>
                                    <tr data-status="Pending">
                                        <td>2025-10-22</td>
                                        <td>Meeting</td>
                                        <td>Final discussion on total bill amount.</td>
                                        <td>Pawan shinde</td>
                                        <td><span class="status-pending">Pending</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <div id="history" class="tab-content">
                <div class="history-timeline">
                    @foreach ($lead->followUps as $follow)
                        <div class="history-entry">
                            <div class="history-date">{{ $follow->created_at->format('d/M/Y H:i') }}</div>
                            <div class="history-details">
                                <span class="history-badge badge-system">Stage Changed</span>
                                Lead moved to <b>{{ $follow->stage }}</b> by <b>{{ $follow->Telecaller }}</b>.
                            </div>
                        </div>
                    @endforeach

                    @if($lead->followUps->isEmpty())
                        <p style="text-align: center; padding: 20px; color: #666;">No history available.</p>
                    @endif
                </div>

            </div>



            <div id="attachment" class="tab-content">
                <div class="attachment-card">
                    <h2>Document Uploads</h2>
                    <p style="color: #666; font-size: 14px; margin-bottom: 30px;">Attach mandatory documents for the customer record.</p>

                    <div class="upload-grid">

                        <div class="upload-item" id="aadhar-front-upload-area">
                            <label for="aadhar-front-file">Aadhar Card Front-Side</label>
                            <input type="file" id="aadhar-front-file" accept=".pdf,.jpg,.jpeg,.png">
                            <button class="upload-button" onclick="document.getElementById('aadhar-front-file').click()">
                                <i class="fa fa-upload"></i> Choose File
                            </button>
                            <span class="upload-status" id="aadhar-front-status">No file chosen</span>
                        </div>

                        <div class="upload-item" id="aadhar-back-upload-area">
                            <label for="aadhar-back-file">Aadhar Card Back-Side</label>
                            <input type="file" id="aadhar-back-file" accept=".pdf,.jpg,.jpeg,.png">
                            <button class="upload-button" onclick="document.getElementById('aadhar-back-file').click()">
                                <i class="fa fa-upload"></i> Choose File
                            </button>
                            <span class="upload-status" id="aadhar-back-status">No file chosen</span>
                        </div>

                        <div class="upload-item" id="pan-upload-area">
                            <label for="pan-file">PAN Card</label>
                            <input type="file" id="pan-file" accept=".pdf,.jpg,.jpeg,.png">
                            <button class="upload-button" onclick="document.getElementById('pan-file').click()">
                                <i class="fa fa-upload"></i> Choose File
                            </button>
                            <span class="upload-status" id="pan-status">No file chosen</span>
                        </div>

                        <div class="upload-item" id="photo-upload-area">
                            <label for="photo-file">Customer Photo</label>
                            <input type="file" id="photo-file" accept=".jpg,.jpeg,.png">
                            <button class="upload-button" onclick="document.getElementById('photo-file').click()">
                                <i class="fa fa-upload"></i> Choose File
                            </button>
                            <span class="upload-status" id="photo-status">No file chosen</span>
                        </div>
                    </div>
                </div>
            </div>


            <div id="lead-transaction" class="tab-content">
                <div class="transaction-card" style="margin-top: 0;">

                    <div class="table-actions-top">
                        <button class="transaction-button" style="margin-right: auto;"><i class="fa fa-filter"></i> Filter</button>
                        <button id="addRowBtn_leadTransaction" class="btn btn-primary" style="margin-left: 10px;"><i class="fa-solid fa-plus"></i> Add Row</button>
                        <button class="transaction-button"><i class="fa-solid fa-file-import"></i> Import</button>
                        <button class="transaction-button"><a href="{{ route('transactions.export.csv') }}" style="color: inherit; text-decoration: none;"><i class="fa-solid fa-file-export"></i> Export</a></button>
                        <button class="transaction-button"><i class="fa-solid fa-rotate-right"></i> Refresh</button>
                        
                          <form id="bulkDeleteForm" action="{{ route('transactions.bulk_destroy') }}" method="POST" style="display: inline;">
                              @csrf
                              <button type="submit" class="btn btn-danger" id="bulkDeleteBtn">
                                  <i class="fa-solid fa-trash"></i> Delete
                              </button>
                          </form>
                        
                    </div>

                    <div class="transaction-table-block" style="padding: 0; margin-top: 0; border: none; box-shadow: none;">
                        <div class="table-responsive">
                            <table id="leadTransactionTable">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectAllTxnCheckboxes"></th>
                                        <th>Service</th>
                                        <th>Bank</th>
                                        <th>Card Type</th>
                                        <th>Charge %</th>
                                        <th>Swip Amount</th>
                                        <th>Swipe Mode</th>
                                        <th>Payment</th>
                                        <th>Pay Mode</th>
                                        <th>Charge Amount</th>
                                        <th>Short</th>
                                        <th>Action</th>
                                    
                                    </tr>
                                </thead>
                                <tbody class="table-data-body" id="leadTransactionTableBody">
                                   @foreach ($lead->transactions as $txn)
                                    <tr>
                                        <td data-label="Select">
                                             <input type="checkbox" name="selected_transactions[]" value="{{$txn->id }}" class="txn-checkbox">
                                        </td>
                                        <td data-label="Service"><a href="#" class="action-link">{{ $txn->Service }}</a></td>
                                        <td data-label="Bank"><a href="#" class="action-link">{{ $txn->Bank }}</a></td>
                                        <td data-label="Card Type">{{ $txn->Card_Type }}</td>
                                        <td data-label="Charge %" style="text-align: right;">{{ $txn->Charge }}</td>
                                        <td data-label="Swip Amount" style="text-align: right;">₹{{ number_format($txn->Swipe_Amt) }}</td>
                                        <td data-label="Swipe Mode">{{ $txn->Swipe_Mode }}</td>
                                        <td data-label="Payment" style="text-align: right;">{{ number_format($txn->Payment) }}</td>
                                        <td data-label="Pay Mode">{{ $txn->Pay_Mode }}</td>
                                        <td data-label="Charge Amount" style="text-align: right;">₹{{ number_format($txn->Charge_Amt) }}</td>
                                        <td data-label="Short" style="text-align: right;">₹{{ number_format($txn->Short) }}</td>
                                    </tr>
                                    @endforeach

                                    @if($lead->transactions->isEmpty())
                                        <tr>
                                            <td colspan="12" style="text-align: center; padding: 20px;">No transactions available.</td>
                                        </tr>
                                        @endif
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <div id="editLeadModal" class="modal-overlay">
                <div class="modal-content">
                    <h3>Lead Basic Info.</h3>
                      <form id="leadEditForm" action="{{ route('leads.update', $lead->id) }}" method="POST">
                        @csrf
                        <!-- if you use PUT method (recommended for updates) -->
                        @method('PUT')
                    
                        <div class="modal-form-grid">
                            <div class="form-group">
                                <label for="modal-name">Name:</label>
                                <input type="text" id="modal-name" name="Name" value="{{ $lead->Name }}">
                            </div>
                    
                            <div class="form-group">
                                <label for="modal-mobile">Mobile:</label>
                                <input type="text" id="modal-mobile" name="Mobile" value="{{ $lead->Mobile }}">
                            </div>
                    
                            <div class="form-group">
                                <label for="modal-city">City:</label>
                                <select id="modal-city" name="City">
                                    <option value="Faridabad" {{ $lead->City == 'Faridabad' ? 'selected' : '' }}>Faridabad</option>
                                    <option value="Delhi" {{ $lead->City == 'Delhi' ? 'selected' : '' }}>Delhi</option>
                                </select>
                            </div>
                    
                            <div class="form-group">
                                <label for="modal-cards">Cards:</label>
                                <input type="text" id="modal-cards" name="Cards" value="{{ $lead->Cards }}">
                            </div>
                    
                            <div class="form-group">
                                <label for="modal-total-bill">Total Bill:</label>
                                <input type="text" id="modal-total-bill" name="Total_Bill" value="{{ $lead->Total_Bill }}">
                            </div>
                    
                            <div class="form-group">
                                <label for="modal-source">Source:</label>
                                <select id="modal-source" name="Source">
                                    <option value="Facebook/Insta" {{ $lead->Source == 'Facebook/Insta' ? 'selected' : '' }}>Facebook/Insta</option>
                                    <option value="Website" {{ $lead->Source == 'Website' ? 'selected' : '' }}>Website</option>
                                    <option value="Walk in Lead" {{ $lead->Source == 'Walk in Lead' ? 'selected' : '' }}>Walk in Lead</option>
                                    <option value="Local Advt" {{ $lead->Source == 'Local Advt' ? 'selected' : '' }}>Local Advt</option>
                                    <option value="Call/IVR" {{ $lead->Source == 'Call/IVR' ? 'selected' : '' }}>Call/IVR</option>
                                    <option value="Reference" {{ $lead->Source == 'Reference' ? 'selected' : '' }}>Reference</option>
                                    <option value="GMB" {{ $lead->Source == 'GMB' ? 'selected' : '' }}>GMB</option>
                                </select>
                            </div>
                    
                            <div class="form-group">
                                <label for="modal-stage">Stage:</label>
                                <select id="modal-stage" name="Stage">
                                    <option value="Converted" {{ $lead->Stage == 'Converted' ? 'selected' : '' }}>Converted</option>
                                    <option value="Not Connected" {{ $lead->Stage == 'Not Connected' ? 'selected' : '' }}>Not Connected</option>
                                </select>
                            </div>
                    
                            <div class="form-group">
                                <label for="modal-owner">Owner:</label>
                                <select id="modal-owner" name="Owner">
                                    <option value="Pawan shinde" {{ $lead->Owner == 'Pawan shinde' ? 'selected' : '' }}>Pawan shinde</option>
                                    <option value="Bhoomika" {{ $lead->Owner == 'Bhoomika' ? 'selected' : '' }}>Bhoomika</option>
                                </select>
                            </div>
                        </div>
                    
                        <div class="modal-footer">
                            <button type="submit" class="save-btn">Save</button>
                        </div>
                    </form>

                </div>
            </div>

            <template id="newRowInputTemplate">
        <tr class="input-row">
<tr class="input-row">
    <td data-label="Select"><input type="checkbox"></td>
    <td data-label="Service">
        <select name="Service" form="txnForm">
            <option value="Card Swipe">Card Swipe</option>
            <option value="UPI">UPI</option>
            <option value="Net Banking">Net Banking</option>
        </select>
    </td>
    <td data-label="Bank"><input type="text" name="Bank" placeholder="Bank Name" form="txnForm"></td>
    <td data-label="Card Type">
        <select name="Card_Type" form="txnForm">
            <option value="Credit">Credit</option>
            <option value="Debit">Debit</option>
        </select>
    </td>
    <td data-label="Charge %" style="text-align:right;">
        <input type="number" name="Charge" step="0.01" placeholder="%" form="txnForm">
    </td>
    <td data-label="Swip Amount" style="text-align:right;">
        <input type="number" name="Swipe_Amt" step="0.01" placeholder="Amount" form="txnForm">
    </td>
    <td data-label="Swipe Mode">
        <select name="Swipe_Mode" form="txnForm">
            <option value="POS">POS</option>
            <option value="Online">Online</option>
        </select>
    </td>
    <td data-label="Payment" style="text-align:right;">
        <input type="number" name="Payment" step="0.01" placeholder="Payment" form="txnForm">
    </td>
    <td data-label="Pay Mode"><input type="text" name="Pay_Mode" placeholder="Mode" form="txnForm"></td>
    <td data-label="Charge Amount" style="text-align:right;">
        <input type="number" name="Charge_Amt" step="0.01" placeholder="Charge" form="txnForm">
    </td>
    <td data-label="Short" style="text-align:right;">
        <input type="number" name="Short" step="0.01" placeholder="Short" form="txnForm">
    </td>
    
    <!-- Form only here -->
    <td data-label="Action">
        <form id="txnForm" action="{{ route('transactions.store') }}" method="POST">
            @csrf
            <input type="hidden" name="lead_id" value="{{ $lead->id }}">
            <button type="submit" class="btn btn-success btn-sm">
                <i class="fa-solid fa-plus"></i>
            </button>
            <button type="button" class="btn btn-danger btn-sm delete-row-btn"><i class="fa-solid fa-trash"></i></button>
        </form>
    </td>
</tr>

</tr>

    </template>
@endsection
</div>
</body>

</html>

<script>
   document.addEventListener('DOMContentLoaded', function() {
            const bulkDeleteForm = document.getElementById('bulkDeleteForm');
            const selectAllCheckbox = document.getElementById('selectAllTxnCheckboxes');
            const leadCheckboxes = document.querySelectorAll('.txn-checkbox');

            // 1. SELECT ALL / DESELECT ALL LOGIC
            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function(e) {
                    leadCheckboxes.forEach(checkbox => {
                        checkbox.checked = e.target.checked;
                    });
                });
            }

            // 2. FORM SUBMISSION LOGIC
            if (bulkDeleteForm) {
                bulkDeleteForm.addEventListener('submit', function(event) {
                    event.preventDefault(); // Prevent default form submission initially

                    // Get all checked lead IDs
                    const selectedCheckboxes = document.querySelectorAll('.txn-checkbox:checked');

                    if (selectedCheckboxes.length === 0) {
                        alert('Please select one or more txn to delete.');
                        return;
                    }

                    // Confirmation dialog
                    const confirmation = confirm(`Are you sure you want to delete ${selectedCheckboxes.length} selected lead(s)? This action cannot be undone.`);

                    if (!confirmation) {
                        return; // Stop here if user cancels
                    }

                    // Remove any previously appended hidden inputs
                    this.querySelectorAll('input[name="selected_transactions[]"]').forEach(input => input.remove());

                    // Create and append a hidden input for each selected ID
                    selectedCheckboxes.forEach(checkbox => {
                        const hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = 'selected_transactions[]'; // Must match controller validation name
                        hiddenInput.value = checkbox.value;
                        this.appendChild(hiddenInput);
                    });

                    // Finally, submit the form with the collected IDs
                    this.submit();
                });
            }
        });

// -------------------- filter code --------------------------       

    document.addEventListener('DOMContentLoaded', function() {
        const transactionSelect = document.getElementById('transaction-select');
        
        if (transactionSelect) {
            // Set the initial selected value based on the URL query parameter 'filter'
            const urlParams = new URLSearchParams(window.location.search);
            const currentFilter = urlParams.get('filter');
            
            // This ensures the dropdown reflects the current filter after a reload
            if (currentFilter) {
                transactionSelect.value = currentFilter;
            } else {
                 // Set to 'all' if no filter is in the URL and the initial selected option is disabled/empty
                 transactionSelect.value = 'all'; 
            }

            // Event listener for when the user changes the filter
            transactionSelect.addEventListener('change', function() {
                const selectedValue = this.value;
                const currentUrl = window.location.href.split('?')[0]; // Get URL without existing query params

                if (selectedValue && selectedValue !== 'all') {
                    // Navigate to the current page URL, adding the new filter query parameter
                    window.location.href = currentUrl + '?filter=' + selectedValue + '#transaction';
                } else {
                    // Navigate to the current page URL, removing the filter parameter
                    window.location.href = currentUrl + '#transaction';
                }
            });
        }
    });

    
</script>