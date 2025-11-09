<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public Form List - CRM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/Publicform.css') }}">
</head>
<body>

  <div class="sidebar-and-public-form-container">

   @extends('layout.app')
   @section('title', 'Main Dashboard')
   @section('content')

    <div class="container">
        <div class="page-header">
            <i class="fas fa-arrow-left back-arrow"></i>
            <h2>Public Form List</h2>
        </div>

        <div class="action-bar">
            <div class="search-box">
                <input type="text" placeholder="search">
            </div>
            <button class="btn refresh-button" id="refreshPublicForms">
                <i class="fas fa-redo-alt"></i> Refresh
            </button>
            <button class="btn add-public-form" id="openPublicFormModalBtn">
                <i class="fas fa-plus"></i> Add New Public Form
            </button>
        </div>

        <div class="table-container">
            <table class="public-form-table">
                <thead>
                    <tr>
                        <th style="width: 10%;">Enabled</th>
                        <th style="width: 20%;">Name</th>
                        <th style="width: 25%;">Link</th>
                        <th style="width: 15%;">Table</th>
                        <th style="width: 15%;">Auto Reply</th>
                        <th style="width: 15%;">Branch</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">
                            <div class="no-data">
                                <i class="fas fa-box-open"></i>
                                <p>No data</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div id="newPublicFormModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="title-group">
                    <i class="fas fa-times close-btn" id="closePublicFormModalBtn"></i>
                    <h3>Public Form</h3>
                </div>
            </div>
            <form id="publicFormForm">
                <div class="form-group">

                <div class="search-container">
                    <input type="text" placeholder="search category">  
                </div><br>

                <div class="form-group toggle-group">
                    <label for="enabledToggle">Enabled</label>
                    <label class="switch">
                        <input type="checkbox" id="enabledToggle" checked>
                        <span class="slider round"></span>
                    </label>
                </div>  
                

                <label for="autoReplyEmail">Name</label>
                <input type="text" id="" placeholder="Enter Name"><br>
                
                <div class="form-group">
                    <label for="publicFormColor"><span class="required"></span>Color</label>
                    <select id="publicFormColor" class="styled-select" required>
                        <option value="">Select a color</option>
                        <option value="red">Red</option>
                        <option value="blue">Blue</option>
                        <option value="green">Green</option>
                        <option value="yellow">Yellow</option>
                        <option value="purple">Purple</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="publicFormTable"><span class="required"></span>Table</label>
                    <select id="publicFormTable" class="styled-select" required>
                        <option value="">Select a table</option>
                        <option value="leads">Leads</option>
                        <option value="contacts">Contacts</option>
                        <option value="deals">Deals</option>
                    </select>
                </div>
                
                <div class="form-group toggle-group">
                    <label for="autoReplyToggle">Auto Reply</label>
                    <label class="switch">
                        <input type="checkbox" id="autoReplyToggle" checked>
                        <span class="slider round"></span>
                    </label>
                </div>

                <div id="autoReplyFields" class="auto-reply-fields">
                    <div class="form-group">
                        <label for="autoReplyTitle">Auto Reply Title</label>
                        <input type="text" id="autoReplyTitle" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="autoReplyEmail">Auto Reply Email</label>
                        <input type="email" id="autoReplyEmail" placeholder="email@example.com">
                    </div>
                    <div class="form-group">
                        <label for="autoReplyMessage">Auto Reply Message</label>
                        
                       
                        <textarea id="autoReplyMessage" placeholder=""></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="publicFormBranch"><span class="required"></span>Branch</label>
                    <select id="publicFormBranch" class="styled-select" required>
                        <option value="">Search</option>
                        <option value="main">Main Branch</option>
                        <option value="sales">Sales Branch</option>
                        <option value="support">Support Branch</option>
                    </select>
                </div>
                
                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </div>
    </div>
    @endsection
    </div>
    <script src="{{ asset('js/Publicform.js') }}"></script>
</body>
</html>