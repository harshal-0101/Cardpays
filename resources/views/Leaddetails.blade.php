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

        <div class="content-area">
            <div id="overview" class="tab-content active">
                <div class="grid-container">
                    <div class="grid-item">
                        <label>Name:</label>
                        <p id="overview-name-value">raj kumar</p>
                    </div>
                    <div class="grid-item">
                        <label>Mobile:</label>
                        <p id="overview-mobile-value">9312123000</p>
                    </div>
                    <div class="grid-item">
                        <label>City:</label>
                        <p id="overview-city-value"><span class="badge">Faridabad</span></p>
                    </div>
                    <div class="grid-item">
                        <label>Cards:</label>
                        <p id="overview-cards-value">4</p>
                    </div>
                    <div class="grid-item">
                        <label>Total Bill:</label>
                        <p id="overview-totalbill-value">Rs. 200,000</p>
                    </div>
                    <div class="grid-item">
                        <label>Stage:</label>
                        <p id="overview-stage-value"><span class="badge">Converted</span></p>
                    </div>
                    <div class="grid-item">
                        <label>Source:</label>
                        <p id="overview-source-value"><span class="badge">Facebook/Insta</span></p>
                    </div>
                    <div class="grid-item">
                        <label>Owner:</label>
                        <p id="overview-owner-value">Pawan shinde</p>
                    </div>
                </div>
            </div>

            <div id="card-details" class="tab-content">

                <div class="card-details-header">
                    <button class="add-new-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Add new
                    </button>
                    <button class="custom-request-btn custom-request-btn-style">Custom request</button>
                </div>

                <div class="card-details-table-wrapper">
                    <table class="card-details-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Bank Name</th>
                                <th>Bill Amount</th>
                                <th>Due Date</th>
                                <th>Card Type</th>
                                <th>Card Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="checkbox" checked></td>
                                <td><span class="bank-badge">ICICI</span></td>
                                <td>5,000</td>
                                <td>13/09/2025</td>
                                <td>Visa</td>
                                <td><span class="status-badge status-active">Active</span></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td><span class="bank-badge">HDFC</span></td>
                                <td>30,000</td>
                                <td>15/09/2025</td>
                                <td>Visa</td>
                                <td><span class="status-badge status-active">Active</span></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td><span class="bank-badge">SBI</span></td>
                                <td>20,000</td>
                                <td>30/09/2025</td>
                                <td>Visa</td>
                                <td><span class="status-badge status-active">Active</span></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td><span class="bank-badge">RBL</span></td>
                                <td>10,000</td>
                                <td>16/09/2025</td>
                                <td>Visa</td>
                                <td><span class="status-badge status-active">Active</span></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td><span class="bank-badge">AXIS</span></td>
                                <td>20,000</td>
                                <td>24/09/2025</td>
                                <td>Visa</td>
                                <td><span class="status-badge status-active">Active</span></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td><span class="bank-badge">YES BANK</span></td>
                                <td>1,111</td>
                                <td>23/10/2025</td>
                                <td>Diners</td>
                                <td><span class="status-badge status-blocked">Blocked/Settled</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-footer">
                    <span>Total 7 items</span>
                    <div class="pagination-controls"><button>&lt;</button><button class="active">1</button><button>&gt;</button></div>
                    <select class="page-size-select"><option>20 / page</option></select>
                </div><br>

                <div class="add-card-form">
                    <div class="form-group"><label for="bank-name-select"></label><select id="bank-name-select"><option value="" disabled selected>Select Bank</option><option value="icici">ICICI</option><option value="hdfc">HDFC</option></select></div>
                    <div class="form-group"><label for="bill-amount-input"></label><input type="number" id="bill-amount-input" placeholder="Bill Amount"></div>
                    <div class="form-group input-with-icon"><label for="due-date-input"></label><input type="date" id="due-date-input" placeholder="Select date"><span class="date-icon">-</span></div>
                    <div class="form-group"><label for="card-type-select"></label><select id="card-type-select"><option value="visa" selected>Visa</option><option value="mastercard">MasterCard</option><option value="diners">Diners</option></select></div>
                    <div class="form-group"><label for="card-status-select"></label><select id="card-status-select"><option value="active" selected>Active</option><option value="blocked">Blocked/Settled</option></select></div>
                    <div class="form-group"><button class="add-card-btn">Add Card</button></div>
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
                                <tbody class="table-data-body">
                                    <tr>
                                        <td data-label="Service"><a href="#" class="action-link">Card Swipe</a></td>
                                        <td data-label="Bank"><a href="#" class="action-link">HDFC Bank</a></td>
                                        <td data-label="Card Type">Credit</td>
                                        <td data-label="Charge %">2.5%</td>
                                        <td data-label="Swip Amount">₹20,000</td>
                                        <td data-label="Swipe Mode">POS</td>
                                        <td data-label="Payment">₹19,500</td>
                                        <td data-label="Pay Mode">TDS</td>
                                        <td data-label="Charge Amount">₹500</td>
                                        <td data-label="Short">₹400</td>
                                    </tr>
                                    <tr>
                                        <td data-label="Service"><a href="#" class="action-link">UPI</a></td>
                                        <td data-label="Bank"><a href="#" class="action-link">SBI</a></td>
                                        <td data-label="Card Type">Debit</td>
                                        <td data-label="Charge %">0.5%</td>
                                        <td data-label="Swip Amount">₹15,000</td>
                                        <td data-label="Swipe Mode">Online</td>
                                        <td data-label="Payment">₹14,925</td>
                                        <td data-label="Pay Mode">Cash</td>
                                        <td data-label="Charge Amount">₹75</td>
                                        <td data-label="Short">₹0</td>
                                    </tr>
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
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Notes</th>
                                        <th>Assigned To</th>
                                        <th>Status</th>
                                    </tr>
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

                    <div class="history-entry">
                        <div class="history-date">08/Oct/2025 23:10 IST</div>
                        <div class="history-details">
                            <span class="history-badge badge-financial">Transaction</span> Processed **₹20,000** Card Swipe payment via **HDFC Bank** (Credit Card).
                        </div>
                    </div>

                    <div class="history-entry">
                        <div class="history-date">08/Oct/2025 23:05 IST</div>
                        <div class="history-details">
                            <span class="history-badge badge-financial">Transaction</span> Processed **₹15,000** UPI payment via **SBI** (Debit Card).
                        </div>
                    </div>

                    <div class="history-entry">
                        <div class="history-date">08/Oct/2025 10:30 IST</div>
                        <div class="history-details">
                            <span class="history-badge badge-manual">Overview Update</span> **Total Bill** updated to **Rs. 200,000** by **Pawan Shinde**.
                        </div>
                    </div>

                    <div class="history-entry">
                        <div class="history-date">01/Oct/2025 14:45 IST</div>
                        <div class="history-details">
                            <span class="history-badge badge-call">Follow Up</span> Follow up task **Completed**: Discussed card details, customer deferred for 1 week. (Logged by **Pawan shinde**).
                        </div>
                    </div>

                    <div class="history-entry">
                        <div class="history-date">24/Sep/2025 18:00 IST</div>
                        <div class="history-details">
                            <span class="history-badge badge-system">Card Added</span> New card added: **AXIS Bank**, Bill ₹20,000, Due 24/09/2025.
                        </div>
                    </div>

                    <div class="history-entry">
                        <div class="history-date">20/Sep/2025 09:15 IST</div>
                        <div class="history-details">
                            <span class="history-badge badge-system">Creation</span> Lead **Raj Kumar** generated from **Facebook/Insta** and assigned to **Pawan shinde**.
                        </div>
                    </div>

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
                        <button class="transaction-button"><i class="fa-solid fa-file-export"></i> Export</button>
                        <button class="transaction-button"><i class="fa-solid fa-rotate-right"></i> Refresh</button>
                        <button class="transaction-button" style="background-color: #dc3545; color: #fff;"><i class="fa-solid fa-trash"></i> Delete</button>
                    </div>

                    <div class="transaction-table-block" style="padding: 0; margin-top: 0; border: none; box-shadow: none;">
                        <div class="table-responsive">
                            <table id="leadTransactionTable">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox"></th>
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
                                    <tr>
                                        <td data-label="Select"><input type="checkbox"></td>
                                        <td data-label="Service"><a href="#" class="action-link">Card Swipe</a></td>
                                        <td data-label="Bank"><a href="#" class="action-link">HDFC Bank</a></td>
                                        <td data-label="Card Type">Credit</td>
                                        <td data-label="Charge %" style="text-align: right;">2.5%</td>
                                        <td data-label="Swip Amount" style="text-align: right;">₹20,000</td>
                                        <td data-label="Swipe Mode">POS</td>
                                        <td data-label="Payment" style="text-align: right;">₹19,500</td>
                                        <td data-label="Pay Mode">TDS</td>
                                        <td data-label="Charge Amount" style="text-align: right;">₹500</td>
                                        <td data-label="Short" style="text-align: right;">₹400</td>
                                        <td data-label="Action"><button type="button" class="btn btn-danger btn-sm delete-row-btn"><i class="fa-solid fa-trash"></i></button></td>
                                    </tr>
                                    <tr>
                                        <td data-label="Select"><input type="checkbox"></td>
                                        <td data-label="Service"><a href="#" class="action-link">UPI</a></td>
                                        <td data-label="Bank"><a href="#" class="action-link">SBI</a></td>
                                        <td data-label="Card Type">Debit</td>
                                        <td data-label="Charge %" style="text-align: right;">0.5%</td>
                                        <td data-label="Swip Amount" style="text-align: right;">₹15,000</td>
                                        <td data-label="Swipe Mode">Online</td>
                                        <td data-label="Payment" style="text-align: right;">₹14,925</td>
                                        <td data-label="Pay Mode">Cash</td>
                                        <td data-label="Charge Amount" style="text-align: right;">₹75</td>
                                        <td data-label="Short" style="text-align: right;">₹0</td>
                                        <td data-label="Action"><button type="button" class="btn btn-danger btn-sm delete-row-btn"><i class="fa-solid fa-trash"></i></button></td>
                                    </tr>
                                </tbody>
                                <tfoot class="table-add-row-footer">
                                    <tr>
                                        <td colspan="12" class="add-row-cell">
                                            <button type="submit" class="btn btn-success btn-sm submit-set-btn" style="float: left;"><i class="fa-solid fa-check"></i> Submit Set</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <div id="editLeadModal" class="modal-overlay">
                <div class="modal-content">
                    <h3>Lead Basic Info.</h3>
                    <form id="leadEditForm">
                        <div class="modal-form-grid">

                            <div class="form-group">
                                <label for="modal-name">Name:</label>
                                <input type="text" id="modal-name" value="raj kumar">
                            </div>
                            <div class="form-group">
                                <label for="modal-mobile">Mobile:</label>
                                <input type="text" id="modal-mobile" value="09312123000">
                            </div>
                            <div class="form-group">
                                <label for="modal-city">City:</label>
                                <select id="modal-city">
                            <option value="Faridabad">Faridabad</option>
                            <option value="Delhi">Delhi</option>
                        </select>
                            </div>

                            <div class="form-group">
                                <label for="modal-cards">Cards:</label>
                                <input type="text" id="modal-cards" value="4">
                            </div>
                            <div class="form-group">
                                <label for="modal-total-bill">Total Bill:</label>
                                <input type="text" id="modal-total-bill" value="200000">
                            </div>
                            <div class="form-group">
                            </div>

                            <div class="form-group">
                                <label for="modal-source">Source:</label>
                                <select id="modal-source">
                            <option value="Facebook/Insta">Facebook/Insta</option>
                            <option value="Website">Website</option>
                            <option value="Walk in Lead">Walk in Lead</option>
                            <option value="Local Advt">Local Advt</option>
                            <option value="Call/IVR">Call/IVR</option>
                            <option value="Reference">Reference</option>
                            <option value="GMB">GMB</option>
                        </select>
                            </div>
                            <div class="form-group">
                                <label for="modal-stage">Stage:</label>
                                <select id="modal-stage">
                            <option value="Converted">Converted</option>
                            <option value="Not Connected">Not Connected</option>
                        </select>
                            </div>
                            <div class="form-group">
                                <label for="modal-owner">Owner:</label>
                                <select id="modal-owner">
                            <option value="Pawan shinde">Pawan shinde</option>
                            <option value="Bhoomika">Bhoomika</option>
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
            <td data-label="Select"><input type="checkbox"></td>
            <td data-label="Service"><select><option value="Card Swipe">Card Swipe</option><option value="UPI">UPI</option><option value="Net Banking">Net Banking</option></select></td>
            <td data-label="Bank"><input type="text" placeholder="Bank Name"></td>
            <td data-label="Card Type"><select><option value="Credit">Credit</option><option value="Debit">Debit</option></select></td>
            <td data-label="Charge %" style="text-align: right;"><input type="number" step="0.01" placeholder="%"></td>
            <td data-label="Swip Amount" style="text-align: right;"><input type="number" step="0.01" placeholder="Amount"></td>
            <td data-label="Swipe Mode"><select><option value="POS">POS</option><option value="Online">Online</option></select></td>
            <td data-label="Payment" style="text-align: right;"><input type="number" step="0.01" placeholder="Payment"></td>
            <td data-label="Pay Mode"><input type="text" placeholder="Mode"></td>
            <td data-label="Charge Amount" style="text-align: right;"><input type="number" step="0.01" placeholder="Charge"></td>
            <td data-label="Short" style="text-align: right;"><input type="number" step="0.01" placeholder="Short"></td>
            <td data-label="Action"><button type="button" class="btn btn-danger btn-sm delete-row-btn"><i class="fa-solid fa-trash"></i></button></td>
        </tr>
    </template>
@endsection
</div>
</body>

</html>