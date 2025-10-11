<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leads Management</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

       <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
        <script src="{{ asset('js/script.js') }}"></script>
</head>
<body>

<div class="sidebar-and-lead-container">

@extends('layout.app')

@section('title', 'Main Dashboard')

@section('content')


<div class="leads-continer-section">

    <header class="header">
        <div class="header-title">
            <h1>Leads</h1>
        </div>
        <div class="header-user">
            <i class="fa-solid fa-bell"></i>
            <div class="user-profile">AD</div>
        </div>
    </header>

 @if (session('success_message'))
    <div class="alert alert-success" role="alert" style="padding: 15px; margin-bottom: 20px; border: 1px solid #d4edda; color: #155724; background-color: #d4edda;">
        {{ session('success_message') }}
    </div>
@endif

<div id="tableView">
    <div class="container">
        <h1>All Leads</h1>
        <div class="table-actions">
            <button class="btn btn-secondary"><i class="fa fa-filter"></i> Filter</button>
            <div class="action-buttons-right">
                <button id="showFormBtn" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add New</button>
                <button class="btn btn-secondary"><i class="fa-solid fa-file-import"></i> Import</button>
                <a href="{{ route('leads.export.csv') }}" class="btn btn-secondary">
                <i class="fa-solid fa-file-export"></i> Export (CSV)
                </a>
                <!-- <button class="btn btn-secondary"><i class="fa-solid fa-file-export"></i> </button> -->
                <button id="refreshBtn" class="btn btn-secondary"><i class="fa-solid fa-rotate-right"></i> Refresh</button>

                 {{-- *** UPDATED BULK DELETE FORM *** --}}
                <form id="bulkDeleteForm" action="{{ route('leads.bulk_destroy') }}" method="POST" style="display: inline;">
                    @csrf
                    {{-- The actual method will be POST, and we send the IDs in the request body --}}
                    
                    {{-- YOUR ORIGINAL DELETE BUTTON --}}
                    <button type="submit" class="btn btn-danger" id="bulkDeleteBtn">
                        <i class="fa-solid fa-trash"></i> Delete
                    </button>
                </form>
                {{-- ********************************* --}}

            </div>
        </div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th><input type="checkbox"></th>
                        <th>Name</th><th>Mobile</th><th>City</th><th>Cards</th><th>Total Bill</th><th>Stage</th><th>Source</th><th>Created at</th><th>Updated at</th><th>Due Days</th><th>Owner</th><th>Created By</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- START: Dynamic content loop --}}
                    @forelse ($leads as $lead)
                    <tr>
                        <td data-label="Select">
                            <input type="checkbox" name="selected_leads_to_delete[]" class="lead-checkbox" value="{{ $lead->id }}">
                        </td>
                        <td data-label="Name"><a href="#" class="action-link">{{ $lead->Name }}</a></td> 
                        <td data-label="Mobile"><a href="tel:{{ $lead->Mobile }}" class="action-link">{{ $lead->Mobile }}</a></td> 
                    
                        <td data-label="City">{{ $lead->City }}</td>
                        <td data-label="Cards">{{ $lead->Cards }}</td>
                        
                        <td data-label="Total Bill">₹{{ $lead->Total_Bill }}</td> 
                        
                        <td data-label="Stage">
                            <span class="status status-{{ Illuminate\Support\Str::slug($lead->Stage) }}">
                                {{ $lead->Stage }}
                            </span>
                        </td>
                        
                        <td data-label="Source">{{ $lead->Source }}</td>
                        
                        <td data-label="Created At">{{ optional($lead->created_at)->format('d/m/Y') ?? $lead->Created_at }}</td>
                        <td data-label="Updated At">{{ optional($lead->updated_at)->format('d/m/Y') ?? $lead->Updated_at }}</td>
                        
                        <td data-label="Due Days">{{ $lead->Due_Days }}</td>
                        <td data-label="Owner">{{ $lead->Owner }}</td>
            
                        <td data-label="Created By"><a href="#" class="action-link">{{ $lead->Created_By }}</a></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="13" class="text-center">No leads found. Click "Add New" to get started.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>  

<div id="formView">
    <div class="wrapper">
        <div class="add-new-header">Add New Lead</div>
        <div class="form-container">
            <h2>Lead Information</h2>
      <form method="POST" action="{{ route('leads.store') }}">
    @csrf
    
    <div class="form-grid">
        
        <div class="form-group span-2">
            <div class="input-wrapper">
                <input 
                    type="text" 
                    id="name" 
                    name="Name" 
                    placeholder=" " 
                    required
                    value="{{ old('Name') }}" {{-- Retains old input --}}
                    class="@error('Name') is-invalid @enderror" {{-- Add error class (optional for styling) --}}
                >
                <label for="name">Name</label>
                <i class="input-icon fa-solid fa-user"></i>
            </div>
            @error('Name')
                <div class="error-message">{{ $message }}</div> {{-- Error message display --}}
            @enderror
        </div>

        <div class="form-group span-2">
            <div class="input-wrapper">
                <input 
                    type="tel" 
                    id="mobile" 
                    name="Mobile" 
                    placeholder=" " 
                    required
                    value="{{ old('Mobile') }}"
                    class="@error('Mobile') is-invalid @enderror"
                >
                <label for="mobile">Mobile</label>
                <i class="input-icon fa-solid fa-phone"></i>
            </div>
            @error('Mobile')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group span-2">
            <div class="input-wrapper">
                <select id="city" name="City" required class="@error('City') is-invalid @enderror">
                    <option value="" disabled {{ old('City') == null ? 'selected' : '' }}>
                    </option>
                    <option value="Mumbai" {{ old('City') == 'Mumbai' ? 'selected' : '' }}>Mumbai</option>
                    <option value="Delhi" {{ old('City') == 'Delhi' ? 'selected' : '' }}>Delhi</option>
                    <option value="Pune" {{ old('City') == 'Pune' ? 'selected' : '' }}>Pune</option>
                </select>
                <label for="city">City</label>
                <i class="input-icon fa-solid fa-city"></i>
            </div>
            @error('City')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group span-3">
            <div class="input-wrapper">
                <input 
                    type="text" 
                    id="cards" 
                    name="Cards" 
                    placeholder=" " 
                    required
                    value="{{ old('Cards') }}"
                    class="@error('Cards') is-invalid @enderror"
                >
                <label for="cards">Cards</label>
                <i class="input-icon fa-solid fa-credit-card"></i>
            </div>
            @error('Cards')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group span-3">
            <div class="input-wrapper">
                <input 
                    type="text" 
                    id="total-bill" 
                    name="Total_Bill" 
                    placeholder=" " 
                    required
                    value="{{ old('Total_Bill') }}"
                    class="@error('Total_Bill') is-invalid @enderror"
                >
                <label for="total-bill">Total Bill</label>
                <i class="input-icon fa-solid fa-receipt"></i>
            </div>
            @error('Total_Bill')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group span-3">
            <div class="input-wrapper">
                <select id="source" name="Source" required class="@error('Source') is-invalid @enderror">
                    <option value="" disabled {{ old('Source') == null ? 'selected' : '' }}>
                    </option>
                    <option value="Facebook/Insta" {{ old('Source') == 'Facebook/Insta' ? 'selected' : '' }}>Facebook/Insta</option>
                    <option value="Google" {{ old('Source') == 'Google' ? 'selected' : '' }}>Google</option>
                    <option value="Referral" {{ old('Source') == 'Referral' ? 'selected' : '' }}>Referral</option>
                </select>
                <label for="source">Source</label>
                <i class="input-icon fa-solid fa-share-nodes"></i>
            </div>
            @error('Source')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group span-3">
            <div class="input-wrapper">
                <select id="stage" name="Stage" required class="@error('Stage') is-invalid @enderror">
                    <option value="" disabled {{ old('Stage') == null ? 'selected' : '' }}>
                    </option>
                    <option value="New Lead" {{ old('Stage') == 'New Lead' ? 'selected' : '' }}>New Lead</option>
                    <option value="Contacted" {{ old('Stage') == 'Contacted' ? 'selected' : '' }}>Contacted</option>
                    <option value="Closed" {{ old('Stage') == 'Closed' ? 'selected' : '' }}>Closed</option>
                </select>
                <label for="stage">Stage</label>
                <i class="input-icon fa-solid fa-flag"></i>
            </div>
            @error('Stage')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group span-6">
            <div class="input-wrapper">
                <select id="owner" name="Owner" required class="@error('Owner') is-invalid @enderror">
                    <option value="" disabled {{ old('Owner') == null ? 'selected' : '' }}>
                    </option>
                    <option value="John Doe" {{ old('Owner') == 'John Doe' ? 'selected' : '' }}>John Doe</option>
                    <option value="Jane Smith" {{ old('Owner') == 'Jane Smith' ? 'selected' : '' }}>Jane Smith</option>
                </select>
                <label for="owner">Owner</label>
                <i class="input-icon fa-solid fa-user-tie"></i>
            </div>
            @error('Owner')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
    </div>
    
    <div class="form-actions">
        <button type="button" class="form-btn btn-cancel" id="hideFormBtn">Cancel</button>
        <button type="submit" class="form-btn btn-submit">Submit Lead</button>
    </div>
</form>
        </div>
    </div>
 </div>
</div>
@endsection
</div>

<script src="script.js"></script>
</body>
</html>
