<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\PeymentMode;

class PeymentModeController extends Controller
{
    function index(){
       
            $paymentModes = PeymentMode::paginate(10);;
            return view('payment_mode', compact('paymentModes'));
       
    }

    public function storepaymode(Request $request)
    {
        try {
            $request->validate([
                'Payment_Mode' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);
    
            PeymentMode::create([
                'Payment_Mode' => $request->Payment_Mode,
                'description'  => $request->description ?? null,
                'Default'      => $request->has('Default'),
                'Enabled'      => $request->has('Enabled')
            ]);
    
            return redirect()->back()->with('success', 'Payment mode added successfully.');
    
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

  public function updateToggle(Request $request, $id)
  {
      $data = $request->only(['field', 'value']);
  
      // validate request
      $validator = \Validator::make($data, [
          'field' => ['required', 'string', 'in:Default,Enabled'],
          'value' => ['required', 'integer', 'in:0,1'],
      ]);
  
      if ($validator->fails()) {
          return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
      }
  
      $payment = \App\Models\PeymentMode::findOrFail($id);
  
      // update allowed field
      $payment->{$data['field']} = $data['value'];
      $payment->save();
  
      return response()->json(['success' => true, 'message' => 'Updated successfully', 'field' => $data['field'], 'value' => $data['value']]);
  }
  
  


   public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:peyment_modes,id',
            'Payment_Mode' => 'required|string|max:255',
            'description' => 'nullable|string',
          
        ]);
    
        $pm = PeymentMode::findOrFail($request->id);
    
        $pm->Payment_Mode = $request->Payment_Mode;
        $pm->description = $request->description;
        $pm->Default = $request->has('Default');
        $pm->Enabled = $request->has('Enabled');
        $pm->save();
    
        return redirect()->back()->with('success', 'Payment mode updated successfully!');
    }


    public function getOne($id)
    {
        $pm = PeymentMode::findOrFail($id);
    
        return response()->json($pm);
    }


   public function destroy($id)
{
    $payment = PeymentMode::findOrFail($id);
    $payment->delete();

    return redirect()->back()->with('success', 'Payment mode deleted successfully!');
}

}
