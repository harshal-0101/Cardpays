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
                        <th>Number</th>
                        <th>Company</th>
                        <th>Date</th>
                        <th>Sub Total</th>
                        <th>Total</th>
                        <th>Note</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>QTL-001</td>
                        <td>Global Tech Solutions</td>
                        <td>2025/11/01</td>
                        <td>$ 1,200.00</td>
                        <td>$ 1,284.00</td>
                        <td>Initial consultation quote.</td>
                        <td><span class="status-badge status-sent">Sent</span></td>
                    </tr>
                    <tr>
                        <td>QTL-002</td>
                        <td>Future Systems Inc.</td>
                        <td>2025/10/25</td>
                        <td>$ 4,500.00</td>
                        <td>$ 4,500.00</td>
                        <td>Quote for V2 upgrade.</td>
                        <td><span class="status-badge status-accepted">Accepted</span></td>
                    </tr>
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

            <form id="quoteForm">
                <div class="form-grid">
                    <div class="form-group span-2">
                        <label>* Lead</label>
                        <input type="text" placeholder="search" list="clientOptions">
                        <datalist id="clientOptions">
                            <option value="Lead A - John Doe"></option>
                            <option value="Lead B - Jane Smith"></option>
                        </datalist>
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
                </div>

                <div class="item-list-container">
                    <div class="item-list-header">
                        <div>Item</div>
                        <div>Description</div>
                        <div>Quantity</div>
                        <div>Price</div>
                        <div>Total</div>
                        <div></div>
                    </div>

                    <div id="itemRowsContainer">
                        <div class="item-row item-template">
                            <input type="text" placeholder="Item Name">
                            <input type="text" placeholder="description Name">
                            <input type="number" value="1" min="0">
                            <div class="price-input-group">
                                <span>$</span>
                                <input type="number" value="0.00" min="0">
                            </div>
                            <div class="price-input-group">
                                <span>$</span>
                                <input type="text" value="00.00" readonly>
                            </div>
                            <i class="fas fa-trash-alt delete-icon" onclick="deleteItemRow(this)"></i>
                        </div>
                    </div>
                </div>

                <button type="button" class="add-field-btn" onclick="addItemRow()">
                    <i class="fas fa-plus"></i> Add Field
                </button>

                <div class="totals-section">
                    <button type="submit" class="save-button-bottom">
                        <i class="fas fa-save"></i> Save
                    </button>

                    <div class="totals-box">
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
                    </div>
                </div>
            </form>
        </div>
    </div>
   @endsection
</div>    
    <script src="{{ asset('js/scriptFile2.js') }}"></script>
</body>
</html>