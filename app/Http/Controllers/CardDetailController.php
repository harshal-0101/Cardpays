<?php

namespace App\Http\Controllers;
use App\Models\CardDetail;
use App\Models\Leads;
use Illuminate\Http\Request;

class CardDetailController extends Controller
{
   public function store(Request $request, Leads $lead)
{
    $request->validate([
        'lead_id' => 'required|integer|exists:leads,id',
        'bank_name' => 'required|string|max:255',
        'bill_amount' => 'required|numeric|min:0',
        'due_date' => 'required|date',
        'card_type' => 'required|string|max:50',
        'card_status' => 'required|string|max:50',
    ]);

   try{

    CardDetail::create([
        'lead_id' => $request->lead_id,
        'bank_name' => $request->bank_name,
        'bill_amount' => $request->bill_amount,
        'due_date' => $request->due_date,
        'card_type' => $request->card_type,
        'card_status' => $request->card_status,
    ]);

    return redirect()->back()->with('success', 'Card details added successfully.');

   }catch(\Exception $e){

       return redirect()->back()->with('error', 'Failed to add card details. Please try again.');

   }

}

public function destroy($id)
{
    try {
        $card = CardDetail::findOrFail($id);
        $card->delete();
        return redirect()->back()->with('success', 'Card deleted successfully!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to delete card. Please try again.');
    }
}
}
