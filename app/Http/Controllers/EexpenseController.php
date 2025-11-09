<?php

namespace App\Http\Controllers;
use App\Models\Eexpense;
use Illuminate\Http\Request;

class EexpenseController extends Controller
{
    public function index()
    {
        $eexpenses = Eexpense::all();
        if($eexpenses->isEmpty()){
            return view('CRMexpense', ['message' => 'No expenses found.'], compact('eexpenses'));
        }else{
             return view('CRMexpense', compact('eexpenses')); 
        }
    }

    public function store(Request $request)
    {
        try{
            
        $validatedData = $request->validate([
            'name'             => 'required|string|max:255',
            'expense_category' => 'required|string|max:100',
            'currency'         => 'required|string|',
            'total'            => 'required|numeric',
            'description'      => 'nullable|string',
            'reference'        => 'nullable|string|max:100',
        ]);

        Eexpense::create($validatedData);

        return redirect()->route('expense.index')->with('success_message', 'Expense created successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: '.$e->getMessage());
        }
       
    }

   public function Search(){
       $searchTerm = request('search');
       $eexpenses = Eexpense::where('name', 'LIKE', "%{$searchTerm}%")
           ->orWhere('expense_category', 'LIKE', "%{$searchTerm}%")
           ->get();

       return view('CRMexpense', compact('eexpenses'));
   }
}
