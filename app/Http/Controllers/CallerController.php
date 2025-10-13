<?php

namespace App\Http\Controllers;
use App\Models\Leads;
use App\Models\FollowUp;
use Illuminate\Http\Request;

class CallerController extends Controller
{
  public function index()
    {
        $totalLeads = Leads::count();
        $leads = Leads::orderBy('Created_By', 'desc')->paginate(10);

        if($totalLeads == null){
            $totalLeads = 0;
        }

         if($leads->isEmpty()){
           return view('crmcaller', ['message' => 'No leads found.'] , compact('totalLeads'));
         }else{
              return view('crmcaller', compact('totalLeads', 'leads')); 
         }

    }

   public function updateStage(Request $request, $id)
   {
       $request->validate([
           'stage' => 'required|string'
       ]);

       $lead = Leads::findOrFail($id);
       $oldStage = $lead->Stage;
       $newStage = $request->stage;

       if($oldStage !== $newStage){
           $lead->Stage = $newStage;
           $lead->save(); 

           FollowUp::create([
            'lead_id'   => $lead->id,
            'stage'     => $newStage,
            'Telecaller'=> auth()->user()->name ?? 'System',  
          ]);
       }


   
       return response()->json([
        'success' => true,
        'message' => $oldStage !== $newStage 
                     ? 'Stage updated and follow-up logged!'
                     : 'No change detected.',
        'new_stage' => $lead->Stage
    ]);
   }


}
