<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offers;

class OffersController extends Controller
{
   public function index()
   {
       $offers = Offers::all();
       return view('CRMleads_offer', compact('offers'));
   }

   public function store(Request $request)
   {
    try {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'lead_id' => 'required|integer|exists:leads,id',
            'date' => 'required|date',
            'expiry_date' => 'nullable|date',
            'status' => 'required|string|max:50',
        ]);

        Offers::create($validated);

        return redirect()
            ->back()
            ->with('success', 'Offer created successfully.');

    } catch (\Exception $e) {

        \Log::error('Error creating offer: ' . $e->getMessage());

        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Failed to create offer! ' . $e->getMessage());
    }
  }

}
