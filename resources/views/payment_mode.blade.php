<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Payment Mode List </title>
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
            <!-- <div class="header-right">
                <div class="search-bar">
                    <i class='bx bx-search'></i>
                    <input type="text" placeholder="search">
                </div>
                <button class="btn btn-secondary">
                    <i class='bx bx-refresh'></i>
                    Refresh
                </button> -->
                <button class="btn btn-primary" id="add-payment-mode-btn">
                    Add New Payment Mode
                </button>
            </div>
        </header>


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

        <div class="list-container">
            <div class="list-row list-header">
                    <span>Payment Mode</span>
                    <span>Description</span>
                    <span>Default</span>
                    <span>Enabled</span>
                    <span></span> 
            </div>
      
     @foreach ($paymentModes as $paymentMode)    
         <div class="list-row data-row">
        
             <span>{{ $paymentMode->Payment_Mode }}</span>
             <span>{{ $paymentMode->description }}</span>
               <span>
              <label class="toggle-switch">
                  <input
                      type="checkbox"
                      name="Default"
                      data-id="{{ $paymentMode->id }}"
                      data-field="Default"
                      {{ $paymentMode->Default ? 'checked' : '' }}>
                  <span class="slider"></span>
              </label>
          </span>
                       <span>
              <label class="toggle-switch">
                  <input
                      type="checkbox"
                      name="Enabled"
                      data-id="{{ $paymentMode->id }}"
                      data-field="Enabled"
                      {{ $paymentMode->Enabled ? 'checked' : '' }}>
                  <span class="slider"></span>
              </label>
          </span>
    
                <span class="more-options" data-id="pm_default_123">
                    <i class='bx bx-dots-horizontal-rounded'></i>
                    <div class="dropdown-menu">
                        <ul>
                            <!-- <li data-action="show">
                                <i class='bx bx-show'></i>
                                <span>Show</span>
                            </li> -->
                            <li data-action="edit" data-id="{{ $paymentMode->id }}">
                                <i class='bx bx-pencil'></i>
                                <span>Edit</span>
                            </li>
                            <li data-action="copy-id" onclick="copyId('{{ $paymentMode->id }}')">
                                <i class='bx bx-copy'></i>
                                <span>Copy ID</span>
                            </li>
                            <li data-action="delete" class="delete-option" onclick="deletePayment({{ $paymentMode->id }})">
                                <i class='bx bx-trash'></i>
                                <span>Delete</span>
                                <form id="deleteForm-{{ $paymentMode->id }}" action="{{ route('payment_modes.destroy', $paymentMode->id) }}" method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                
                            </li>
                        </ul>
                    </div>
                </span>
               
            </div>
             @endforeach
                @if($paymentModes->isEmpty())
                    <span colspan="5">No payment modes found.</span>
                @endif
        </div>

       <div class="pagination">

          {{-- Previous Button --}}
          @if ($paymentModes->onFirstPage())
              <a class="disabled"><i class='bx bx-chevron-left'></i></a>
          @else
              <a href="{{ $paymentModes->previousPageUrl() }}"><i class='bx bx-chevron-left'></i></a>
          @endif
      
          {{-- Page Numbers --}}
          @foreach ($paymentModes->links()->elements[0] ?? [] as $page => $url)
              @if ($page == $paymentModes->currentPage())
                  <a class="active">{{ $page }}</a>
              @else
                  <a href="{{ $url }}">{{ $page }}</a>
              @endif
          @endforeach
      
          {{-- Next Button --}}
          @if ($paymentModes->hasMorePages())
              <a href="{{ $paymentModes->nextPageUrl() }}"><i class='bx bx-chevron-right'></i></a>
          @else
              <a class="disabled"><i class='bx bx-chevron-right'></i></a>
          @endif
        </div>

    </div>

    <div class="panel-overlay" id="panel-overlay"></div>

    <div class="slide-in-panel" id="add-payment-mode-panel">
        <div class="panel-header">
            <h2>Add New Payment Mode</h2>
            <button class="close-btn" id="close-add-panel-btn">&times;</button>
        </div>
        
        <form class="admin-form" id="add-payment-mode-form" method="POST" action="{{ route('setting.payment_mode.store') }}">
            @csrf
            <div class="form-group">
                <label for="pm-name">Payment Mode <span class="required-asterisk">*</span></label>
                <input type="text" id="pm-name" required name="Payment_Mode">
            </div>
            
            <div class="form-group">
                <label for="pm-description">Description</label>
                <input type="text" id="pm-description" name="description">
            </div>
            
            <div class="form-group form-group-toggle">
                <label for="pm-default">Default</label>
                <label class="toggle-switch">
                    <input type="checkbox" id="pm-default" name="Default" value="0" > 
                    <span class="slider"></span>
                </label>
            </div>

            <div class="form-group form-group-toggle">
                <label for="pm-enabled">Enabled</label>
                <label class="toggle-switch">
                    <input type="checkbox" id="pm-enabled" name="Enabled" checked value="1"> 
                    <span class="slider"></span>
                </label>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
    </div>
    
    <!-- <div class="slide-in-panel" id="show-payment-mode-panel">
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
    </div> -->

    <div class="slide-in-panel" id="edit-payment-mode-panel">
        <div class="panel-header">
            <h2>Edit Payment Mode</h2>
            <button class="close-btn" id="close-edit-panel-btn">&times;</button>
        </div>
        
        <form class="admin-form" id="edit-payment-mode-form" method="POST" action="{{ route('payment-modes.update') }}">
            @csrf
            <input type="hidden" name="id" id="edit-pm-id">
        
            <div class="form-group">
                <label for="edit-pm-name">Payment Mode <span class="required-asterisk">*</span></label>
                <input type="text" id="edit-pm-name" name="Payment_Mode" required>
            </div>
            
            <div class="form-group">
                <label for="edit-pm-description">Description</label>
                <input type="text" id="edit-pm-description" name="description">
            </div>
            
            <div class="form-group">
                <label for="edit-pm-default">Default</label>
                <label class="toggle-switch">
                    <input type="checkbox" id="edit-pm-default" name="Default">
                    <span class="slider"></span>
                </label>
            </div>
            
            <div class="form-group">
                <label for="edit-pm-enabled">Enabled</label>
                <label class="toggle-switch">
                    <input type="checkbox" id="edit-pm-enabled" name="Enabled">
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    if (!csrfToken) {
        console.error('CSRF token not found. Make sure <meta name="csrf-token"> is present.');
        return;
    }

    async function updatePaymentMode(id, field, value) {
        try {
            const res = await fetch(`/payment-modes/update-toggle/${id}`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": csrfToken
                },
                body: JSON.stringify({
                    field: field,
                    value: value // 1 or 0
                })
            });

            if (!res.ok) {
                const text = await res.text();
                console.error('Server error', res.status, text);
                return;
            }

            const data = await res.json();
            console.log('UPDATED:', data);
        } catch (err) {
            console.error('Fetch error:', err);
        }
    }

    // attach change handlers
    document.querySelectorAll('.toggle-switch input[type="checkbox"]').forEach(input => {
        input.addEventListener('change', function () {
            const id = this.dataset.id;
            const field = this.dataset.field || this.name;

            if (!id || !field) {
                console.error('Missing data-id or data-field/name for checkbox', this);
                return;
            }

            const value = this.checked ? 1 : 0;
            updatePaymentMode(id, field, value);
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {

    // Open Edit Panel
    document.querySelectorAll('[data-action="edit"]').forEach(item => {
        item.addEventListener('click', function () {
            let id = this.dataset.id;

            fetch(`/payment-modes/${id}`)
                .then(res => res.json())
                .then(data => {
                    // Fill form fields
                    document.getElementById('edit-pm-id').value = data.id;
                    document.getElementById('edit-pm-name').value = data.Payment_Mode;
                    document.getElementById('edit-pm-description').value = data.description ?? "";
                    document.getElementById('edit-pm-default').checked = data.Default == 1;
                    document.getElementById('edit-pm-enabled').checked = data.Enabled == 1;

                    // Open panel
                    document.getElementById('edit-payment-mode-panel').classList.add('open');
                    document.getElementById('panel-overlay').classList.add('active');
                });
        });
    });

    // Close edit panel
    document.getElementById('cancel-edit-btn').addEventListener('click', function () {
        document.getElementById('edit-payment-mode-panel').classList.remove('open');
        document.getElementById('panel-overlay').classList.remove('active');
    });

});

function deletePayment(id) {
    if (confirm("Are you sure you want to delete this payment mode?")) {
        document.getElementById('deleteForm-' + id).submit();
    }
}


function copyId(id) {
    navigator.clipboard.writeText(id)
        .then(() => {
            alert("ID copied: " + id);
        })
        .catch(() => {
            alert("Failed to copy ID");
        });
}


</script>




</html>