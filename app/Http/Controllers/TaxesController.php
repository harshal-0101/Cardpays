<?php

namespace App\Http\Controllers;
use App\Models\Taxes;
use Illuminate\Http\Request;

class TaxesController extends Controller
{
    function index(){
        $taxes = Taxes::paginate(10);
        return view('taxes', compact('taxes'));
    }

    function storeTax(Request $request)
{
    try {
        $request->validate([
            'Name' => 'required|string|max:255',
            'rate' => 'required|numeric|min:0',
        ]); 

        Taxes::create([
            'Name'    => $request->Name,
            'rate'    => $request->rate,
            'Default' => $request->has('Default'),
            'Enabled' => $request->has('Enabled')
        ]);
        return redirect()->back()->with('success', 'Tax added successfully.');  
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while adding the tax.' . $e->getMessage());
    }
}

 function updateToggle(Request $request, $id)
{
    $data = $request->only(['field', 'value']);

    $validator = \Validator::make($data, [
        'field' => ['required', 'string', 'in:Default,Enabled'],
        'value' => ['required', 'integer', 'in:0,1'],
    ]);

    if ($validator->fails()) {
        return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
    }

    $tax = \App\Models\Taxes::findOrFail($id);

    $tax->{$data['field']} = $data['value'];
    $tax->save();

    return response()->json([
        'success' => true,
        'message' => 'Updated successfully',
        'field' => $data['field'],
        'value' => $data['value']
    ]);
}

public function show($id)
{
    return \App\Models\Tax::findOrFail($id);
}

// public function updateTax(Request $request, $id)
// {
//    try{
//     $tax = \App\Models\Tax::findOrFail($id);

//     $tax->Name = $request->name;
//     $tax->Value = $request->value;
//     $tax->Default = $request->default ? 1 : 0;
//     $tax->Enabled = $request->enabled ? 1 : 0;

//     $tax->save();

//     return response()->json([
//         'success' => true,
//         'message' => 'Tax updated successfully!'
//     ]);
//    } catch (\Exception $e) {
//     return response()->json([
//         'success' => false,
//         'message' => 'An error occurred while updating the tax. ' . $e->getMessage()
//     ], 500);
    
// }

// }

public function update(Request $request)
{
    try {
        $request->validate([
            'id' => 'required|integer|exists:taxes,id',
            'name' => 'required|string|max:255',
            'rate' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $taxes = Taxes::findOrFail($request->id);

        $taxes->Name = $request->name;
        $taxes->rate = $request->rate;
        $taxes->Default = $request->has('Default');
        $taxes->Enabled = $request->has('Enabled');
        $taxes->save();

        return redirect()->back()->with('success', 'Tax updated successfully!');
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while updating the tax. ' . $e->getMessage()
        ], 500);
    }
}



function destroy($id)
{
    $taxes = Taxes::findOrFail($id);
    $taxes->delete();

    return redirect()->back()->with('success', 'Tax deleted successfully!');
}

public function edit($id)
    {
        $tax = Taxes::findOrFail($id); 
        // Pass the tax object to your view
        return view('setting.taxes', compact('tax'));
    }


}