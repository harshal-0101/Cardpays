<?php

namespace App\Http\Controllers;
use App\Models\Leads;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LeadsController extends Controller
{
   public function index()
   {
       $leads = Leads::all();
       if($leads->isEmpty()){
           return view('Lead', ['message' => 'No leads found.']);
       }else{
            return view('Lead', compact('leads')); 
       }
   }

    // app/Http/Controllers/LeadController.php

public function store(Request $request)
{

    $validatedData = $request->validate([
        'Name'       => 'required|string|max:255',
        'Mobile'     => 'required|string|max:20|unique:leads,Mobile', 
        'City'       => 'required|string|max:100',
        'Cards'      => 'nullable|string|max:100', 
        'Total_Bill' => 'required|numeric',
        'Source'     => 'required|string|max:100',
        'Stage'      => 'required|string|max:100',
        'Owner'      => 'required|string|max:100',
    ]);

    $validatedData['Due_Days'] = 0;

    $validatedData['Created_By'] = auth()->check() ? auth()->user()->name : 'System/Guest';

    Leads::create($validatedData);

    return redirect()->route('leads.Lead')->with('success_message', 'Lead created successfully!');

    // return redirect()->route('Lead')->with('success', 'Lead created successfully!');
}

public function bulkDestroy(Request $request)
{
    $request->validate([
        'selected_leads' => 'required|array',
        'selected_leads.*' => 'exists:leads,id', // Ensure all IDs exist
    ]);

    $leadIds = $request->input('selected_leads');

    // Use Eloquent's destroy for efficient bulk deletion
    $count = Leads::destroy($leadIds);

    return redirect()->route('leads.Lead')->with('success_message', "Successfully deleted {$count} leads.");
}

     public function exportCsv(): StreamedResponse
    {
        // 1. Define the columns/headers
        $headers = [
            'ID', 'Name', 'Mobile', 'City', 'Cards', 'Total Bill', 'Stage', 
            'Source', 'Due Days', 'Owner', 'Created By', 'Created At', 'Updated At'
        ];
        
        // Define the filename
        $filename = 'leads_export_' . now()->format('Ymd_His') . '.csv';

        // 2. Create the streaming response
        $callback = function() use ($headers) 
        {
            $file = fopen('php://output', 'w');
            
            // Write the headers to the file
            fputcsv($file, $headers);

            // Fetch data in chunks to handle large datasets efficiently
            Leads::chunk(2000, function ($leads) use ($file) {
                foreach ($leads as $lead) {
                    // Create an array matching the header order
                    $row = [
                        $lead->id,
                        $lead->Name,
                        $lead->Mobile,
                        $lead->City,
                        $lead->Cards,
                        $lead->Total_Bill,
                        $lead->Stage,
                        $lead->Source,
                        $lead->Due_Days,
                        $lead->Owner,
                        $lead->Created_By,
                        optional($lead->created_at)->toDateTimeString(),
                        optional($lead->updated_at)->toDateTimeString(),
                    ];
                    fputcsv($file, $row);
                }
            });
            
            fclose($file);
        };

        // 3. Return the response with correct headers for download
        return new StreamedResponse($callback, 200, [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

}
