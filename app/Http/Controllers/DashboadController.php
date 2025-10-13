<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leads;
class DashboadController extends Controller
{
    public function index()
    {
        $totalLeads = Leads::count();
        $totalConversions = Leads::where('Stage', 'Converted')->count();

        if($totalLeads == null){
            $totalLeads = 0;
            $totalConversions = 0;
        }

        return view('crmadmin', compact('totalLeads', 'totalConversions'));
    }
}
