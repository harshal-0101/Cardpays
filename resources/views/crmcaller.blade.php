<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cards Pay - Telecaller Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>


<div class="sidebar-and-caller-container">
    
@extends('layout.app')

@section('title', 'Main Dashboard')

@section('content')

    <div class="dashboard-layout">
        <header class="header">
            <div class="header-title">
                <h1>Telecaller</h1>
            </div>
            <div class="header-user">
                <i class="fa-solid fa-bell"></i>
                <div class="user-profile">AD</div>
            </div>
        </header>
        
        <main class="main-content">
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="icon" style="background-color: var(--primary-color);"><i class="fa-solid fa-users"></i></div>
                    <div class="info">
                        <h3>My Leads</h3>
                        <p>{{ number_format($totalLeads) }}</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="icon" style="background-color: var(--warning);"><i class="fa-solid fa-calendar-day"></i></div>
                    <div class="info">
                        <h3>Today's Follow-ups</h3>
                        <p>28</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="icon" style="background-color: var(--success);"><i class="fa-solid fa-chart-line"></i></div>
                    <div class="info">
                        <h3>Conversion Rate</h3>
                        <p>12.5%</p>
                    </div>
                </div>
            </div>
                <div class="content-block">
        <h3>All Assigned Leads</h3>
        <div class="data-table-wrapper">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Name</th><th>Mobile</th><th>City</th><th>Cards</th><th>Total Bill</th>
                            <th>Stage</th>
                            <th>Source</th><th>Created at</th><th>Updated at</th><th>Due Days</th><th>Owner</th><th>Created By</th><th></th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- *** THE LOOP STARTS HERE *** --}}
                        @foreach ($leads as $lead)
                        <tr>
                            <td data-label="Name">{{ $lead->Name }}</td>
                            <td data-label="Mobile">{{ $lead->Mobile }}</td>
                            <td data-label="City">{{ $lead->City }}</td>
                            <td data-label="Cards">{{ $lead->Cards }}</td>
                            <td data-label="Total Bill">₹{{ number_format($lead->Total_Bill) }}</td>
                            
                      <td data-label="Stage">
                          <div class="stage-wrapper">
                              <select class="stage-selector" 
                                      data-lead-id="{{ $lead->id }}" 
                                      data-original-stage="{{ $lead->Stage }}">
                                  @php
                                      $stages = ['Contacted', 'Not Connected', 'Converted', 'Closed'];
                                  @endphp
                                  @foreach ($stages as $stage)
                                      <option value="{{ $stage }}" {{ $lead->Stage == $stage ? 'selected' : '' }}>
                                          {{ $stage }}
                                      </option>
                                  @endforeach
                              </select>
                              <span class="stage-status-msg" style="margin-left: 8px; font-size: 13px;"></span>
                          </div>
                      </td>

                            
                            <td data-label="Source">{{ $lead->Source }}</td>
                            <td data-label="Created At">{{ $lead->created_at->format('d/m/Y') }}</td>
                            <td data-label="Updated At">{{ $lead->updated_at->format('d/m/Y') }}</td>
                            <td data-label="Due Days">{{ $lead->Due_Days ?? '-' }}</td>
                            <td data-label="Owner">{{ $lead->Owner }}</td>
                            <td data-label="Created By"><a href="#" class="action-link">{{ $lead->Created_By }}</a></td>
                            <!-- <td data-label="Actions">
                                <a href="#" class="action-link">Edit</a>
                            </td> -->
                        </tr>
                        @endforeach

                        @if ($leads->isEmpty())
                            <tr>
                                <td colspan="12" class="text-center p-4">No leads assigned yet.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        
        {{-- Paginaton Links --}}
        <div class="mt-4">
            {{ $leads->links() }}
        </div>
    </div>

        </main>
    </div>
@endsection
</div>
</body>
<script>

$(document).ready(function() {
    $('.stage-selector').on('change', function() {
        const select = $(this);
        const leadId = select.data('lead-id');
        const newStage = select.val();
        const oldStage = select.data('original-stage');
        const msg = select.closest('.stage-wrapper').find('.stage-status-msg');

        // Show saving message
        msg.css('color', 'blue').text('Saving...');
        select.prop('disabled', true);

        $.ajax({
            url: `/leads/${leadId}/update-stage`,
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                stage: newStage
            },
            success: function(response) {
                if (response.success) {
                    msg.css('color', 'green').text('✅ ' + response.message);
                    select.data('original-stage', newStage);
                    console.log('Stage updated successfully');
                } else {
                    msg.css('color', 'red').text('❌ Failed to update!');
                    select.val(oldStage);
                    console.error('Failed to update stage');
                }
            },
            error: function(xhr) {
                msg.css('color', 'red').text('❌ Error updating stage!');
                select.val(oldStage); // revert on error
                console.error('Error:', xhr.responseText);
            },
            complete: function() {
                select.prop('disabled', false);
                // Remove message after 3 seconds
                setTimeout(() => msg.fadeOut(300, () => msg.text('').show()), 3000);
            }
        });
    });
});

</script>

</script>
</html>