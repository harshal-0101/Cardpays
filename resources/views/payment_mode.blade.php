<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Mode List UI</title>
    <link rel="stylesheet" href="{{asset('css/payments.css')}}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<div class="sidebar-and-payment-mode-container">

   @extends('layout.app')
   @section('title', 'Main Dashboard')
   @section('content')

    <div class="admin-panel">
        <header>
            <div class="header-left">
                <i class='bx bx-arrow-back'></i>
                <h1>Payment Mode List</h1>
            </div>
            <div class="header-right">
                <div class="search-bar">
                    <i class='bx bx-search'></i>
                    <input type="text" placeholder="search">
                </div>
                <button class="btn btn-secondary">
                    <i class='bx bx-refresh'></i>
                    Refresh
                </button>
                <button class="btn btn-primary" id="add-payment-mode-btn">
                    Add New Payment Mode
                </button>
            </div>
        </header>

        <div class="list-container">
            <div class="list-row list-header">
                <span>Payment Mode</span>
                <span>Description</span>
                <span>Default</span>
                <span>Enabled</span>
                <span></span> </div>

            <div class="list-row data-row">
                <span>Default Payment</span>
                <span>Default Payment Mode (Cash, Wire Transfert)</span>
                <span>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                </span>
                <span>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                </span>

                <span class="more-options" data-id="pm_default_123">
                    <i class='bx bx-dots-horizontal-rounded'></i>
                    <div class="dropdown-menu">
                        <ul>
                            <li data-action="show">
                                <i class='bx bx-show'></i>
                                <span>Show</span>
                            </li>
                            <li data-action="edit">
                                <i class='bx bx-pencil'></i>
                                <span>Edit</span>
                            </li>
                            <li data-action="copy-id">
                                <i class='bx bx-copy'></i>
                                <span>Copy ID</span>
                            </li>
                            <li data-action="delete" class="delete-option">
                                <i class='bx bx-trash'></i>
                                <span>Delete</span>
                            </li>
                        </ul>
                    </div>
                </span>
            </div>
        </div>

        <div class="pagination">
            <a href="#" class="disabled"><i class='bx bx-chevron-left'></i></a>
            <a href="#" class="active">1</a>
            <a href="#"><i class='bx bx-chevron-right'></i></a>
        </div>
    </div>

    <div class="panel-overlay" id="panel-overlay"></div>

    <div class="slide-in-panel" id="add-payment-mode-panel">
        <div class="panel-header">
            <h2>Add New Payment Mode</h2>
            <button class="close-btn" id="close-add-panel-btn">&times;</button>
        </div>
        
        <form class="admin-form" id="add-payment-mode-form">
            <div class="form-group">
                <label for="pm-name">Payment Mode <span class="required-asterisk">*</span></label>
                <input type="text" id="pm-name" required>
            </div>
            
            <div class="form-group">
                <label for="pm-description">Description</label>
                <input type="text" id="pm-description">
            </div>
            
            <div class="form-group form-group-toggle">
                <label for="pm-default">Default</label>
                <label class="toggle-switch">
                    <input type="checkbox" id="pm-default">
                    <span class="slider"></span>
                </label>
            </div>

            <div class="form-group form-group-toggle">
                <label for="pm-enabled">Enabled</label>
                <label class="toggle-switch">
                    <input type="checkbox" id="pm-enabled" checked>
                    <span class="slider"></span>
                </label>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
    </div>
    
    <div class="slide-in-panel" id="show-payment-mode-panel">
        <div class="panel-header">
            <h2>Payment Mode Details</h2>
            <button class="close-btn" id="close-show-panel-btn">&times;</button>
        </div>
        
        <div class="show-panel-content">
            <div class="admin-details">
                <div class="detail-item">
                    <span class="detail-label">Payment Mode</span>
                    <span class="detail-colon">:</span>
                    <span class="detail-value" id="show-pm-name">Default Payment</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Description</span>
                    <span class="detail-colon">:</span>
                    <span class="detail-value" id="show-pm-description">Default Payment Mode (Cash, Wire Transfert)</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Is Default</span>
                    <span class="detail-colon">:</span>
                    <span class="detail-value" id="show-pm-default">Yes</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Is Enabled</span>
                    <span class="detail-colon">:</span>
                    <span class="detail-value" id="show-pm-enabled">Yes</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Payment Mode ID</span>
                    <span class="detail-colon">:</span>
                    <span class="detail-value" id="show-pm-id">pm_default_123</span>
                </div>
            </div>
        </div>
    </div>

    <div class="slide-in-panel" id="edit-payment-mode-panel">
        <div class="panel-header">
            <h2>Edit Payment Mode</h2>
            <button class="close-btn" id="close-edit-panel-btn">&times;</button>
        </div>
        
        <form class="admin-form" id="edit-payment-mode-form">
            <div class="form-group">
                <label for="edit-pm-name">Payment Mode <span class="required-asterisk">*</span></label>
                <input type="text" id="edit-pm-name" value="Default Payment" required>
            </div>
            
            <div class="form-group">
                <label for="edit-pm-description">Description</label>
                <input type="text" id="edit-pm-description" value="Default Payment Mode (Cash, Wire Transfert)">
            </div>
            
            <div class="form-group">
                <label for="edit-pm-default">Default</label>
                <label class="toggle-switch">
                    <input type="checkbox" id="edit-pm-default" checked>
                    <span class="slider"></span>
                </label>
            </div>
            
            <div class="form-group">
                <label for="edit-pm-enabled">Enabled</label>
                <label class="toggle-switch">
                    <input type="checkbox" id="edit-pm-enabled" checked>
                    <span class="slider"></span>
                </label>
            </div>
            
            <div class="form-group edit-btn-group">
                <button type="submit" class="btn btn-primary save-btn">Save</button>
                <button type="button" class="btn btn-secondary cancel-btn" id="cancel-edit-btn">Cancel</button>
            </div>
        </form>
    </div>
    @endsection
   </div>
    <script src="{{ asset('js/payments.js') }}"></script>
</body>
</html>