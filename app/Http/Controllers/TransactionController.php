<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
class TransactionController extends Controller
{
    //  public function create()
    //   {
    //       $leads = Leads::select('id', 'Name', 'Mobile')->get();
     
    //       return view('transactions.form', compact('leads'));
    //   }

public function show(Request $request, Lead $lead)
{
    
    $filter = $request->get('filter', 'all'); 
    
    $transactionQuery = $lead->transactions(); 

    if ($filter === 'last_30') {
        $dateLimit = Carbon::now()->subDays(30);
    } elseif ($filter === 'last_90') {
        $dateLimit = Carbon::now()->subDays(90);
    } 

    if (isset($dateLimit)) {
        $transactionQuery->where('created_at', '>=', $dateLimit);
    }

    $transactions = $transactionQuery->get(); 

    return view('your.lead.show', [
        'lead' => $lead,
        'transactions' => $transactions,
    ]);   
}

public function store(Request $request)
{
    $request->validate([
        'lead_id' => 'required|integer',
        'Service' => 'required|string|max:255',
        'Bank' => 'required|string|max:255',
        'Card_Type' => 'required|string|max:255',
        'Charge' => 'required|numeric',
        'Swipe_Amt' => 'required|numeric',
        'Swipe_Mode' => 'required|string|max:255',
        'Payment' => 'required|numeric',
        'Pay_Mode' => 'required|string|max:255',
        'Charge_Amt' => 'required|numeric',
        'Short' => 'required|numeric',
    ]);

    try {
        Transaction::create([
            'lead_id' => $request->lead_id,
            'Service' => $request->Service,
            'Bank' => $request->Bank,
            'Card_Type' => $request->Card_Type,
            'Charge' => $request->Charge,
            'Swipe_Amt' => $request->Swipe_Amt,
            'Swipe_Mode' => $request->Swipe_Mode,
            'Payment' => $request->Payment,
            'Pay_Mode' => $request->Pay_Mode,
            'Charge_Amt' => $request->Charge_Amt,
            'Short' => $request->Short,
        ]);

        return back()->with('success', 'Transaction added successfully.');
    } catch (\Exception $e) {
        return back()->with('error', 'Something went wrong: ' . $e->getMessage());
    }
}


    //    public function updateData($id)
    //    {
        
    //    }

 public function bulkDestroy(Request $request)
    {
        try{

        $selectedIds = $request->input('selected_transactions'); 
         
        if (empty($selectedIds)) {
            return redirect()->back()->with('error', 'No transactions were selected for deletion.');
        }
        
        $deletedCount = Transaction::whereIn('id', $selectedIds)->delete();

        return redirect()->back()->with('success', $deletedCount . ' transactions deleted successfully.');
    
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: '.$e->getMessage(), $e->getCode(),$e);
        }
    }

    public function exportCsv(){
        $fileName = 'transactions.csv';
        $transactions = Transaction::all();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['ID', 'Lead ID', 'Service', 'Bank', 'Card Type', 'Charge', 'Swipe Amount', 'Swipe Mode', 'Payment', 'Pay Mode', 'Charge Amount', 'Short', 'Created At', 'Updated At'];

        $callback = function() use($transactions, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($transactions as $transaction) {
                $row['ID']  = $transaction->id;
                $row['Lead ID']    = $transaction->lead_id;
                $row['Service']    = $transaction->Service;
                $row['Bank']    = $transaction->Bank;
                $row['Card Type']    = $transaction->Card_Type;
                $row['Charge']    = $transaction->Charge;
                $row['Swipe Amount']    = $transaction->Swipe_Amt;
                $row['Swipe Mode']    = $transaction->Swipe_Mode;
                $row['Payment']    = $transaction->Payment;
                $row['Pay Mode']    = $transaction->Pay_Mode;
                $row['Charge Amount']    = $transaction->Charge_Amt;
                $row['Short']    = $transaction->Short;
                $row['Created At']  = $transaction->created_at;
                $row['Updated At']  = $transaction->updated_at;

                fputcsv($file, array($row['ID'], $row['Lead ID'], $row['Service'], $row['Bank'], $row['Card Type'], $row['Charge'], $row['Swipe Amount'], $row['Swipe Mode'], $row['Payment'], $row['Pay Mode'], $row['Charge Amount'], $row['Short'], $row['Created At'], $row['Updated At']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
