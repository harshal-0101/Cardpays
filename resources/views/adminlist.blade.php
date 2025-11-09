<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin List UI</title>
    <link rel="stylesheet" href="{{asset('css/adminlist.css')}}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<div class="sidebar-and-Adminlist-container">

   @extends('layout.app')
   @section('title', 'Main Dashboard')
   @section('content')

    <div class="admin-panel">
        <header>
            <div class="header-left">
                <i class='bx bx-arrow-back'></i>
                <h1>Admin List</h1>
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
                <button class="btn btn-primary" id="add-admin-btn">
                    Add New Admin
                </button>
            </div>
        </header>

        <div class="admin-list-container">
            <div class="list-row list-header">
                <span>First Name</span>
                <span>Last Name</span>
                <span>Email</span>
                <span>Role</span>
                <span>Branch</span>
                <span>Enabled</span>
                <span></span> </div>

            <div class="list-row data-row">
                <span>dhruv limbasiya</span>
                <span></span> <span>limbasiyadhruv735@gmail.com</span>
                <span>
                    <span class="badge badge-owner">Account Owner</span>
                </span>
                <span>
                    <span class="badge badge-branch">Main</span>
                </span>
                <span>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                </span>

                <span class="more-options">
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
                            <li data-action="update-password">
                                <i class='bx bx-lock-alt'></i>
                                <span>Update Password</span>
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

    <div class="panel-overlay" id="panel-overlay"></div>

    <div class="slide-in-panel" id="admin-form-panel">
        <div class="panel-header">
            <h2>Add New Admin</h2>
            <button class="close-btn" id="close-panel-btn">&times;</button>
        </div>
        
        <form class="admin-form" id="add-admin-form">
            <div class="form-group">
                <label for="first-name">First Name <span class="required-asterisk">*</span></label>
                <input type="text" id="first-name" required>
            </div>
            
            <div class="form-group">
                <label for="last-name">Last Name <span class="required-asterisk">*</span></label>
                <input type="text" id="last-name" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email <span class="required-asterisk">*</span></label>
                <input type="email" id="email" required>
            </div>
            
            <div class="form-group">
                <label for="branch">Branch <span class="required-asterisk">*</span></label>
                <select id="branch" required>
                    <option value="" disabled selected>select</option>
                    <option value="main">Main</option>
                    <option value="secondary">Secondary</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="password">Password <span class="required-asterisk">*</span></label>
                <div class="password-wrapper">
                    <input type="password" id="password" required>
                    <i class='bx bx-hide' id="toggle-password"></i>
                </div>
            </div>
            
            <div class="form-group">
                <label for="role">Role <span class="required-asterisk">*</span></label>
                <select id="role" required>
                    <option value="" disabled selected>select</option>
                    <option value="owner">Account Owner</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            
            <div class="form-group form-group-toggle">
                <label for="enabled">Enabled</label>
                <label class="toggle-switch">
                    <input type="checkbox" id="enabled" checked>
                    <span class="slider"></span>
                </label>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
    </div>
    
    <div class="slide-in-panel" id="show-admin-panel">
        
    <div class="panel-header">
        <h2>Admin</h2>
        <button class="close-btn" id="close-show-panel-btn">&times;</button>
    </div>
    
    <div class="show-panel-content">

        <div class="admin-details">
            <div class="detail-item">
                <span class="detail-label">First Name</span>
                <span class="detail-colon">:</span>
                <span class="detail-value">dhruv limbasiya</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Last Name</span>
                <span class="detail-colon">:</span>
                <span class="detail-value"></span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Email</span>
                <span class="detail-colon">:</span>
                <span class="detail-value">limbasiyadhruv735@gmail.com</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Role</span>
                <span class="detail-colon">:</span>
                <span class="detail-value">owner</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Branch</span>
                <span class="detail-colon">:</span>
                <span class="detail-value"></span>
            </div>
        </div>
    </div>
</div>


<div class="slide-in-panel" id="edit-admin-panel">
    <div class="panel-header">
        <h2>Edit Admin</h2>
        <button class="close-btn" id="close-edit-panel-btn">&times;</button>
    </div>
    
    <form class="admin-form" id="edit-admin-form">
        <div class="form-group">
            <label for="edit-first-name">First Name <span class="required-asterisk">*</span></label>
            <input type="text" id="edit-first-name" value="dhruv limbasiya" required>
        </div>
        
        <div class="form-group">
            <label for="edit-last-name">Last Name <span class="required-asterisk">*</span></label>
            <input type="text" id="edit-last-name" value="" required>
        </div>
        
        <div class="form-group">
            <label for="edit-email">Email <span class="required-asterisk">*</span></label>
            <input type="email" id="edit-email" value="limbasiyadhruv735@gmail.com" required>
        </div>
        
        <div class="form-group">
            <label for="edit-branch">Branch <span class="required-asterisk">*</span></label>
            <select id="edit-branch" required>
                <option value="main" selected>Main</option>
                <option value="secondary">Secondary</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="edit-role">Role <span class="required-asterisk">*</span></label>
            <select id="edit-role" required>
                <option value="owner" selected>Account Owner</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </div>
        
        <div class="form-group form-group-toggle">
            <label for="edit-enabled">Enabled</label>
            <label class="toggle-switch">
                <input type="checkbox" id="edit-enabled" checked>
                <span class="slider"></span>
            </label>
        </div>
        
        <div class="form-group edit-btn-group">
            <button type="submit" class="btn btn-primary save-btn">Save</button>
            <button type="button" class="btn btn-secondary cancel-btn" id="cancel-edit-btn">Cancel</button>
        </div>
    </form>
</div>

<div class="slide-in-panel" id="update-password-panel">
    <div class="panel-header">
        <h2>Update Password</h2>
        <button class="close-btn" id="close-password-panel-btn">&times;</button>
    </div>
    
    <form class="admin-form" id="update-password-form">
        <div class="form-group">
            <label for="new-password">New Password <span class="required-asterisk">*</span></label>
            <div class="password-wrapper">
                <input type="password" id="new-password" required>
                <i class='bx bx-hide' id="toggle-new-password"></i>
            </div>
        </div>
        
        <div class="form-group edit-btn-group">
            <button type="submit" class="btn btn-primary save-btn">Save</button>
            <button type="button" class="btn btn-secondary cancel-btn" id="cancel-password-btn">Cancel</button>
        </div>
    </form>
</div>
    @endsection
    </div>

    <script src="{{ asset('js/adminlist.js') }}"></script>
</body>
</html>