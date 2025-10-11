<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
     public function create()
      {
         
          $leads = Leads::select('id', 'Name', 'Mobile')->get();
     
          return view('transactions.form', compact('leads'));
      }

      public function store(Request $request)
       {
       
           $validatedData = $request->validate([
               'lead_id'    => 'required|exists:leads,id', 
               'Service'    => 'required|string|max:255',
               'Bank'       => 'required|string|max:255',
               'Card_Type'  => 'required|string|max:255',
               'Charge'     => 'required|numeric',
               'Swipe_Amt'  => 'required|numeric',
               'Swipe_Mode' => 'required|string|max:255',
               'Payment'    => 'required|numeric',
               'Pay_Mode'   => 'required|string|max:255',
               'Charge_Amt' => 'required|numeric',
               'Short'      => 'required|numeric',
               'receivable' => 'required|numeric',
           ]);

           Transaction::create($validatedData);
           return redirect()->route('transactions.create')->with('success_message', 'Transaction recorded successfully!');
                            
       }

       public function updateData($id)
       {
        //    updata function ------------------------->>>
       }

       public function destroy($id)
       {
           $transaction = Transaction::findOrFail($id);
           $transaction->delete();
           return redirect()->route('transactions.create')->with('success_message', 'Transaction deleted successfully!');
       }
}
