<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxes List UI</title>
    <link rel="stylesheet" href="{{asset('css/taxes.css')}}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<div class="sidebar-and-setting-container">

   @extends('layout.app')
   @section('title', 'Main Dashboard')
   @section('content')

    <div class="admin-panel">
        <header>
            <div class="header-left">
                <i class='bx bx-arrow-back'></i>
                <h1>Taxes List</h1>
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
                <button class="btn btn-primary" id="add-tax-btn">
                    Add New Tax
                </button>
            </div>
        </header>

        <div class="list-container">
            <div class="list-row list-header">
                <span>Name</span>
                <span>Value</span>
                <span>Default</span>
                <span>Enabled</span>
                <span></span> </div>

            <div class="list-row data-row">
                <span>Tax 0%</span>
                <span>0%</span>
                <span>
                    <label class="toggle-switch">
                        <input type="checkbox">
                        <span class="slider"></span>
                    </label>
                </span>
                <span>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                </span>

                <span class="more-options" data-id="tax_12345">
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

    <div class="slide-in-panel" id="add-tax-panel">
        <div class="panel-header">
            <h2>Add New Tax</h2>
            <button class="close-btn" id="close-add-panel-btn">&times;</button>
        </div>
        
        <form class="admin-form" id="add-tax-form">
            <div class="form-group">
                <label for="tax-name">Name <span class="required-asterisk">*</span></label>
                <input type="text" id="tax-name" required>
            </div>
            
            <div class="form-group">
                <label for="tax-value">Value (e.g., 5% or 10) <span class="required-asterisk">*</span></label>
                <input type="text" id="tax-value" required>
            </div>
            
            <div class="form-group form-group-toggle">
                <label for="tax-default">Default</label>
                <label class="toggle-switch">
                    <input type="checkbox" id="tax-default">
                    <span class="slider"></span>
                </label>
            </div>

            <div class="form-group form-group-toggle">
                <label for="tax-enabled">Enabled</label>
                <label class="toggle-switch">
                    <input type="checkbox" id="tax-enabled" checked>
                    <span class="slider"></span>
                </label>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
    </div>
    
    <div class="slide-in-panel" id="show-tax-panel">
        <div class="panel-header">
            <h2>Tax Details</h2>
            <button class="close-btn" id="close-show-panel-btn">&times;</button>
        </div>
        
        <div class="show-panel-content">
            <div class="admin-details">
                <div class="detail-item">
                    <span class="detail-label">Name</span>
                    <span class="detail-colon">:</span>
                    <span class="detail-value" id="show-tax-name">Tax 0%</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Value</span>
                    <span class="detail-colon">:</span>
                    <span class="detail-value" id="show-tax-value">0%</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Is Default</span>
                    <span class="detail-colon">:</span>
                    <span class="detail-value" id="show-tax-default">No</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Is Enabled</span>
                    <span class="detail-colon">:</span>
                    <span class="detail-value" id="show-tax-enabled">Yes</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Tax ID</span>
                    <span class="detail-colon">:</span>
                    <span class="detail-value" id="show-tax-id">tax_12345</span>
                </div>
            </div>
        </div>
    </div>

    <div class="slide-in-panel" id="edit-tax-panel">
        <div class="panel-header">
            <h2>Edit Tax</h2>
            <button class="close-btn" id="close-edit-panel-btn">&times;</button>
        </div>
        
        <form class="admin-form" id="edit-tax-form">
            <div class="form-group">
                <label for="edit-tax-name">Name <span class="required-asterisk">*</span></label>
                <input type="text" id="edit-tax-name" value="Tax 0%" required>
            </div>
            
            <div class="form-group">
                <label for="edit-tax-value">Value <span class="required-asterisk">*</span></label>
                <input type="text" id="edit-tax-value" value="0%" required>
            </div>
            
            <div class="form-group">
                <label for="edit-tax-default">Default</label>
                <label class="toggle-switch">
                    <input type="checkbox" id="edit-tax-default">
                    <span class="slider"></span>
                </label>
            </div>
            
            <div class="form-group">
                <label for="edit-tax-enabled">Enabled</label>
                <label class="toggle-switch">
                    <input type="checkbox" id="edit-tax-enabled" checked>
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
    <script src="{{ asset('js/taxes.js') }}"></script>
</body>
</html>