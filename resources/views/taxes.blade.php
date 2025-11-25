<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">   
    <title>Taxes</title>
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

        <div id="ajax-alert" style="display:none;" class="alert"></div>


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
                <span>Name</span>
                <span>Value</span>
                <span>Default</span>
                <span>Enabled</span>
                <span></span> 
            </div>
@foreach($taxes as $tax) 
            <div class="list-row data-row">
               
                <span>{{ $tax->Name }}</span>
                <span>{{ $tax->rate }}%</span>
              <span>
                  <label class="toggle-switch">
                      <input type="checkbox" class="toggle-input" data-id="{{ $tax->id }}" data-field="Default"{{ $tax->Default ? 'checked' : '' }}>
                      <span class="slider"></span>
                  </label>
              </span>
              
              <span>
                  <label class="toggle-switch">
                      <input type="checkbox" class="toggle-input" data-id="{{ $tax->id }}" data-field="Enabled" {{ $tax->Enabled ? 'checked' : '' }}>

                      <span class="slider"></span>
                  </label>
              </span>



                <span class="more-options" data-id="tax_12345">
                    <i class='bx bx-dots-horizontal-rounded'></i>
                    <div class="dropdown-menu">
                        <ul>
                            <!-- <li data-action="show">
                                <i class='bx bx-show'></i>
                                <span>Show</span>
                            </li> -->
                           <li data-action="edit" class="edit-btn" data-id="{{ $tax->id }}" data-name="{{ $tax->Name }}" data-rate="{{ $tax->rate }}" data-default="{{ $tax->Default }}"data-enabled="{{ $tax->Enabled }}">
                                <i class='bx bx-pencil'></i>
                                <span>Edit</span>
                            </li>
                            <li data-action="copy-id">
                                <i class='bx bx-copy'></i>
                                <span>Copy ID</span>
                            </li>
                            <li data-action="delete" class="delete-option" onclick="deleteTax({{ $tax->id }})">
                                <i class='bx bx-trash'></i>
                                <span>Delete</span>
                                <form id="deleteForm-{{ $tax->id }}" action="{{ route('tax.destroy', $tax->id) }}" method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </li>
                        </ul>
                    </div>
                </span>
               
            </div>
       @endforeach

                @if($taxes->isEmpty())
                    <p>No taxes available.</p>
                @endif      
        </div>

        <div class="pagination">
              @if ($taxes->onFirstPage())
              <a class="disabled"><i class='bx bx-chevron-left'></i></a>
          @else
              <a href="{{ $taxes->previousPageUrl() }}"><i class='bx bx-chevron-left'></i></a>
          @endif
      
          {{-- Page Numbers --}}
          @foreach ($taxes->links()->elements[0] ?? [] as $page => $url)
              @if ($page == $taxes->currentPage())
                  <a class="active">{{ $page }}</a>
              @else
                  <a href="{{ $url }}">{{ $page }}</a>
              @endif
          @endforeach
      
          {{-- Next Button --}}
          @if ($taxes->hasMorePages())
              <a href="{{ $taxes->nextPageUrl() }}"><i class='bx bx-chevron-right'></i></a>
          @else
              <a class="disabled"><i class='bx bx-chevron-right'></i></a>
          @endif
        </div>
    </div>

    <div class="panel-overlay" id="panel-overlay"></div>

    <div class="slide-in-panel" id="add-tax-panel">
        <div class="panel-header">
            <h2>Add New Tax</h2>
            <button class="close-btn" id="close-add-panel-btn">&times;</button>
        </div>
        
        <form class="admin-form" id="add-tax-form" method="POST" action="{{ route('tax.store') }}">
            @csrf

            <div class="form-group">
                <label for="tax-name">Name <span class="required-asterisk">*</span></label>
                <input type="text" id="tax-name" name="Name" required >
            </div>
            
            <div class="form-group">
                <label for="tax-value">Value (e.g., 5% or 10) <span class="required-asterisk">*</span></label>
                <input type="text" id="tax-value" name="rate" required>
            </div>
            
            <div class="form-group form-group-toggle">
                <label for="tax-default">Default</label>
                <label class="toggle-switch">
                    <input type="checkbox" id="tax-default" name="Default" value="1">
                    <span class="slider"></span>
                </label>
            </div>

            <div class="form-group form-group-toggle">
                <label for="tax-enabled">Enabled</label>
                <label class="toggle-switch">
                    <input type="checkbox" id="tax-enabled" name="Enabled" value="1" checked>
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
        
        <form class="admin-form" id="edit-tax-form" method="post" action="{{route('taxes.update')}}">
            @csrf
            @method('Post')
            <input type="hidden" id="edit-tax-id" name="id" >

            <div class="form-group">
                <label for="edit-tax-name">Name <span class="required-asterisk">*</span></label>
                <input type="text" id="edit-tax-name" name="name" required>
            </div>
            
            <div class="form-group">
                <label for="edit-tax-value">Value <span class="required-asterisk">*</span></label>
                <input type="text" id="edit-tax-value" name="rate"  required>
            </div>
            
            <div class="form-group">
                <label for="edit-tax-default">Default</label>
                <label class="toggle-switch">
                    <input type="checkbox" id="edit-tax-default"  name="Default">
                    <span class="slider"></span>
                </label>
            </div>
            
            <div class="form-group">
                <label for="edit-tax-enabled">Enabled</label>
                <label class="toggle-switch">
                    <input type="checkbox" id="edit-tax-enabled" name="Enabled" checked >
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
<Script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-input').forEach(input => {
        input.addEventListener('change', function () {
            let id = this.dataset.id;
            let field = this.dataset.field;  // Default or Enabled
            let value = this.checked ? 1 : 0;

            fetch(`/tax/update-toggle/${id}`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ field: field, value: value })
            })
            .then(res => res.json())
            .then(data => {
                console.log(data);
            })
            .catch(err => console.error(err));
        });
    });
});

function deleteTax(id) {
    if (confirm("Are you sure you want to delete this payment mode?")) {
        document.getElementById('deleteForm-' + id).submit();
    }
}

// -------------show old data in form Tax Panel ----------------
document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll(".edit-btn").forEach(btn => {
        btn.addEventListener("click", function () {

            // Open panel
            document.getElementById("edit-tax-panel").classList.add("open");

            // Set old values
            document.getElementById("edit-tax-id").value = this.dataset.id;
            document.getElementById("edit-tax-name").value = this.dataset.name;
            document.getElementById("edit-tax-value").value = this.dataset.rate;

            document.getElementById("edit-tax-default").checked =
                this.dataset.default == "1";

            document.getElementById("edit-tax-enabled").checked =
                this.dataset.enabled == "1";
        });
    });

});


// --------------- edit tax data---------------



// ---------error msg-------------




</Script>

</html>