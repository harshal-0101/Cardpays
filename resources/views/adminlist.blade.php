<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin List</title>
    <link rel="stylesheet"  href="{{asset('css/adminlist.css') }}">
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
                <h1>Admin List</h1>
            </div>
            <div class="header-right">
                <div class="search-bar">
                    <i class='bx bx-search'></i>
                    <input type="text" placeholder="search">
                </div>
                <button class="btn btn-secondary" onclick="location.reload()">
                    <i class='bx bx-refresh'></i>
                    Refresh
                </button>
                <button class="btn btn-primary" id="add-admin-btn">
                    Add New Admin
                </button>
            </div>
        </header>

        <div class="admin-list-container" id="main-list-container">
            <div class="list-row list-header">
                <span>First Name</span>
                <span>Email</span>
                <span>Role</span>
                <span>Branch</span>
                <span>Enabled</span>
                <span></span> 
            </div>
@foreach($AllAcount as $AllAC)
            <div class="list-row data-row"  data-id="{{ $AllAC->id }}"data-name="{{ $AllAC->name }}" data-email="{{ $AllAC->email }}"data-branch="{{ $AllAC->Branch }}" data-role="{{ $AllAC->User_Role }}" data-enabled="{{ $AllAC->Enabled }}">
                
                <span>{{$AllAC->name}}</span>
                <span></span> 
                <span>{{$AllAC->email}}</span>
                <span>
                    <span class="badge badge-owner">{{$AllAC->User_Role}}</span>
                </span>
                <span>
                    <span class="badge badge-branch">{{$AllAC->Branch}}</span>
                </span>
                <span>
                    <label class="toggle-switch">
                        <input type="checkbox" class="enabled-toggle-checkbox" data-user-id="{{ $AllAC->id }}" {{ $AllAC->Enabled ? 'checked' : '' }}>
                        <span class="slider"></span>
                    </label>
                </span>
                <span class="more-options">
                    <i class='bx bx-dots-horizontal-rounded'></i>
                    <div class="dropdown-menu">
                        <ul>
                            <li data-action="edit"><i class='bx bx-pencil'></i><span>Edit</span></li>
                            <li data-action="copy-id"><i class='bx bx-copy'></i><span>Copy ID</span></li>
                            <li data-action="update-password"><i class='bx bx-lock-alt'></i><span>Update Password</span></li>
                            <li class="delete-option">
                    {{-- Form that targets the DELETE route --}}
                    <form method="POST" action="{{ url('/user/delete/' . $AllAC->id) }}" onsubmit="return confirm('Are you sure you want to delete this admin?');" style="display:inline;">
                        @csrf
                        @method('DELETE') 
                        <button type="submit" style="background:none; border:none; padding:0; margin:0; cursor:pointer; color:inherit; width:100%; text-align:left;">
                            <i class='bx bx-trash'></i><span>Delete</span>
                        </button>
                    </form>
                        </ul>
                    </div>
                </span>
            
            </div>
 @endforeach
        
            
            

            <div id="dynamic-data-container"></div>
        </div>

 <div class="pagination">

    {{-- Previous Button --}}
    @if ($AllAcount->onFirstPage())
        <a class="disabled"><i class='bx bx-chevron-left'></i></a>
    @else
        <a href="{{ $AllAcount->previousPageUrl() }}"><i class='bx bx-chevron-left'></i></a>
    @endif

    {{-- Page Numbers --}}
    @foreach ($AllAcount->links()->elements as $element)
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $AllAcount->currentPage())
                    <a class="active">{{ $page }}</a>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next Button --}}
    @if ($AllAcount->hasMorePages())
        <a href="{{ $AllAcount->nextPageUrl() }}"><i class='bx bx-chevron-right'></i></a>
    @else
        <a class="disabled"><i class='bx bx-chevron-right'></i></a>
    @endif

</div>

    </div>

    <div class="panel-overlay" id="panel-overlay"></div>

    <div class="slide-in-panel" id="admin-form-panel">
        <div class="panel-header">
            <h2>Add New Admin</h2>
            <button class="close-btn" id="close-panel-btn">&times;</button>
        </div>
        <form class="admin-form" id="add-admin-form" method="post" action="{{route('user.store')}}">
             @csrf
             @method("post")
            <div class="form-group">
                <label for="first-name">First Name <span class="required-asterisk">*</span></label>
                <input type="text" id="first-name" required name="name">
            </div>
            <!-- <div class="form-group">
                <label for="last-name">Last Name <span class="required-asterisk">*</span></label>
                <input type="text" id="last-name" name="email" required>
            </div> -->
            <div class="form-group">
                <label for="email">Email <span class="required-asterisk">*</span></label>
                <input type="email" id="email" required name="email">
            </div>
            <div class="form-group">
                <label for="branch">Branch <span class="required-asterisk">*</span></label>
                <select id="branch" required name="Branch">
                    <option value="" disabled selected>select</option>
                    <option value="main">Main</option>
                    <option value="secondary">Secondary</option>
                </select>
            </div>
            <div class="form-group">
                <label for="password">Password <span class="required-asterisk">*</span></label>
                <div class="password-wrapper">
                    <input type="password" id="password" required name="password">
                    <i class='bx bx-hide' id="toggle-password"></i>
                </div>
            </div>
            <div class="form-group">
                <label for="role">Role <span class="required-asterisk">*</span></label>
                <select id="role" required name="User_Role">
                    <option value="" disabled selected>select</option>
                    <option value="owner">Account Owner</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <div class="form-group form-group-toggle">
                <label for="enabled">Enabled</label>
                <label class="toggle-switch">
                    <input type="checkbox" id="enabled" checked name="Enabled">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
    </div>
    
    <!-- <div class="slide-in-panel" id="show-admin-panel">
        <div class="panel-header">
            <h2>Admin Details</h2>
            <button class="close-btn" id="close-show-panel-btn">&times;</button>
        </div>
        <div class="show-panel-content">
            <div class="admin-details">
                <div class="detail-item">
                    <span class="detail-label">First Name</span><span class="detail-colon">:</span><span class="detail-value" id="show-firstname"></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Last Name</span><span class="detail-colon">:</span><span class="detail-value" id="show-lastname"></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Email</span><span class="detail-colon">:</span><span class="detail-value" id="show-email"></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Role</span><span class="detail-colon">:</span><span class="detail-value" id="show-role"></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Branch</span><span class="detail-colon">:</span><span class="detail-value" id="show-branch"></span>
                </div>
            </div>
        </div>
    </div> -->

    <div class="slide-in-panel" id="edit-admin-panel">
        <div class="panel-header">
            <h2>Edit Admin</h2>
            <button class="close-btn" id="close-edit-panel-btn">&times;</button>
        </div>
        <form class="admin-form" id="edit-admin-form" method="POST">
             @csrf
             @method('PUT')
            <input type="hidden" id="edit-id"> 
            <div class="form-group">
                <label for="edit-first-name">First Name <span class="required-asterisk">*</span></label>
                <input type="text" id="edit-first-name" required>
            </div>
            <!-- <div class="form-group">
                <label for="edit-last-name">Last Name <span class="required-asterisk">*</span></label>
                <input type="text" id="edit-last-name" required>
            </div> -->
            <div class="form-group">
                <label for="edit-email">Email <span class="required-asterisk">*</span></label>
                <input type="email" id="edit-email" required>
            </div>
            <div class="form-group">
                <label for="edit-branch">Branch <span class="required-asterisk">*</span></label>
                <select id="edit-branch" required>
                    <option value="main">Main</option>
                    <option value="secondary">Secondary</option>
                </select>
            </div>
            <div class="form-group">
                <label for="edit-role">Role <span class="required-asterisk">*</span></label>
                <select id="edit-role" required>
                    <option value="owner">Account Owner</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <div class="form-group form-group-toggle">
                <label for="edit-enabled">Enabled</label>
                <label class="toggle-switch">
                    <input type="checkbox" id="edit-enabled">
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
            <input type="hidden" id="password-user-id">
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

    <template id="admin-row-template">
        <div class="list-row data-row">
            <span class="row-fname"></span>
            <span class="row-lname"></span>
            <span class="row-email"></span>
            <span class="row-role"></span>
            <span class="row-branch"></span>
            <span>
                <label class="toggle-switch">
                    <input type="checkbox" class="row-enabled-chk">
                    <span class="slider"></span>
                </label>
            </span>
            <span class="more-options">
                <i class='bx bx-dots-horizontal-rounded'></i>
                <div class="dropdown-menu">
                    <ul>
                        <li data-action="show"><i class='bx bx-show'></i><span>Show</span></li>
                        <li data-action="edit"><i class='bx bx-pencil'></i><span>Edit</span></li>
                        <li data-action="copy-id"><i class='bx bx-copy'></i><span>Copy ID</span></li>
                        <li data-action="update-password"><i class='bx bx-lock-alt'></i><span>Update Password</span></li>
                        <li data-action="delete" class="delete-option"><i class='bx bx-trash'></i><span>Delete</span></li>
                    </ul>
                </div>
            </span>
        </div>
    </template>
   @endsection
    </div> 

    <script src="{{ asset('js/adminlist.js') }}"></script>
</body>
<script>
   
 document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll('.more-options li[data-action="edit"]').forEach(btn => {
        btn.addEventListener('click', function () {

            let row = this.closest('.data-row');

            document.getElementById('edit-id').value = row.dataset.id;
            document.getElementById('edit-first-name').value = row.dataset.name;
            document.getElementById('edit-email').value = row.dataset.email;
            document.getElementById('edit-branch').value = row.dataset.branch;
            document.getElementById('edit-role').value = row.dataset.role;
            document.getElementById('edit-enabled').checked = row.dataset.enabled == 1;

            // document.getElementById('edit-admin-panel').classList.add('open');
            // document.getElementById('panel-overlay').classList.add('active');
        });
    });

   // ... inside document.addEventListener("DOMContentLoaded", function () { ...

    document.getElementById('edit-admin-form').addEventListener('submit', function (e) {
        e.preventDefault(); // This is what stops the traditional form submit

        let id = document.getElementById('edit-id').value;
     
        fetch(`/user/update/${id}`, {
            method: "PUT", 
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
               
                name: document.getElementById('edit-first-name').value,
                email: document.getElementById('edit-email').value,
                Branch: document.getElementById('edit-branch').value,
                User_Role: document.getElementById('edit-role').value,
                Enabled: document.getElementById('edit-enabled').checked ? 1 : 0
            })
        })
        .then(res => {
            if (!res.ok) {
                // Check for non-2xx status codes
                throw new Error(`HTTP error! status: ${res.status}`);
            }
            // Try to parse JSON, or handle if no JSON is returned (e.g., redirect)
            const contentType = res.headers.get("content-type");
            if (contentType && contentType.indexOf("application/json") !== -1) {
                return res.json();
            } else {
                return {}; // Return empty object if response is not JSON
            }
        })
        .then(data => {
            console.log("Response data:", data); 
            alert("Update Successful ✅");
            location.reload();
        })
        .catch(err => {
            console.error("Fetch error:", err);
            alert("Update Failed ❌: " + err.message);
        });
    });

// ... });


   document.addEventListener('change', async function (e) {
    if (!e.target.matches('.enabled-toggle-checkbox')) return;

    const checkbox = e.target;
    const userId = checkbox.dataset.userId;
    const isEnabled = checkbox.checked ? 1 : 0;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    // Optional: visual feedback while request in-flight
    checkbox.disabled = true;

    try {
      const res = await fetch(`/user/toggle-enabled/${encodeURIComponent(userId)}`, {
        method: 'POST', 
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify({ Enabled: isEnabled })
      });

      if (!res.ok) {
      
        let errText = `HTTP ${res.status}`;
        try {
          const errJson = await res.json();
          if (errJson.message) errText += ` — ${errJson.message}`;
        } catch (_) {}
        throw new Error(errText);
      }

      const data = await res.json();
      console.log('Toggle success:', data);

      // Sync the checkbox to server's saved state (in case server coerces)
      checkbox.checked = Number(data.enabled) === 1;
    } catch (err) {
      console.error('Error updating enabled status:', err);
      // revert UI change on failure
      checkbox.checked = !checkbox.checked;
      // show user-friendly error
      alert('Failed to update status: ' + err.message);
    } finally {
      checkbox.disabled = false;
    }
  });


//   ----------------- delete ----- user--------------------------

//--------------------show update password----------------------------

// --- Code to show Update Password Panel ---
document.querySelectorAll('.more-options li[data-action="update-password"]').forEach(btn => {
    btn.addEventListener('click', function () {
        let row = this.closest('.data-row');
        let userId = row.dataset.id;
        
        // 1. Set the hidden user ID in the form
        document.getElementById('password-user-id').value = userId;
        
        // 2. Clear any old password value
        document.getElementById('new-password').value = '';
        
        // 3. Open the panel and overlay
        document.getElementById('update-password-panel').classList.add('open');
        document.getElementById('panel-overlay').classList.add('active');
        
        // 4. Close the dropdown menu immediately
        this.closest('.dropdown-menu').style.display = 'none';
    });
});

// --- Code to Handle Password Update Submission ---
document.getElementById('update-password-form').addEventListener('submit', function (e) {
    e.preventDefault();

    const id = document.getElementById('password-user-id').value;
    const newPassword = document.getElementById('new-password').value;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    // Basic password validation
    if (newPassword.length < 8) {
        alert("Password must be at least 8 characters long.");
        return;
    }

    fetch(`/user/update-password/${id}`, {
        method: 'PATCH', // Use PATCH for partial updates
        headers: {
            "X-CSRF-TOKEN": csrfToken,
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            // Send the new password to the controller
            password: newPassword
        })
    })
    .then(response => {
        if (!response.ok) {
            // Check for non-2xx status codes (e.g., 422 validation or 500 error)
            return response.json().then(errorData => {
                throw new Error(errorData.message || `HTTP error! Status: ${response.status}`);
            });
        }
        return response.json();
    })
    .then(data => {
        alert("Password updated successfully! ✅");
        location.reload();
        
        // Close the panel on success
        document.getElementById('update-password-panel').classList.remove('open');
        document.getElementById('panel-overlay').classList.remove('active');
    })
    .catch(error => {
        console.error('Password Update Error:', error);
        alert('Password Update Failed ❌: ' + error.message);
    });
});

// --- Panel Close Button Handlers (If you don't have them yet) ---
document.getElementById('cancel-password-btn').addEventListener('click', function() {
    document.getElementById('update-password-panel').classList.remove('open');
    document.getElementById('panel-overlay').classList.remove('active');
});

document.getElementById('close-password-panel-btn').addEventListener('click', function() {
    document.getElementById('update-password-panel').classList.remove('open');
    document.getElementById('panel-overlay').classList.remove('active');
});

// --- New Code for Copy ID Action ---
document.querySelectorAll('.more-options li[data-action="copy-id"]').forEach(btn => {
    btn.addEventListener('click', function () {
        // 1. Get the closest data row and retrieve the user ID
        const row = this.closest('.data-row');
        const userId = row.dataset.id;
        
        // 2. Use the modern Clipboard API to copy the text
        if (navigator.clipboard) {
            navigator.clipboard.writeText(userId)
                .then(() => {
                    alert(`User ID "${userId}" copied to clipboard! 📋`);
                })
                .catch(err => {
                    console.error('Failed to copy ID:', err);
                    alert('Failed to copy ID. Please check console.');
                });
        } else {
            // Fallback for older browsers (Less reliable, but good to have)
            const textArea = document.createElement("textarea");
            textArea.value = userId;
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            try {
                document.execCommand('copy');
                alert(`User ID "${userId}" copied to clipboard! 📋`);
            } catch (err) {
                console.error('Fallback copy failed:', err);
            }
            document.body.removeChild(textArea);
        }

        // 3. Close the dropdown menu after clicking
        this.closest('.dropdown-menu').style.display = 'none'; 
    });
});

});




</script>
</html>