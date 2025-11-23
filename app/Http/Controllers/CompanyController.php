<?php

namespace App\Http\Controllers;
use \App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    function index()
    {
        $company = Company::first(); 
        return view('CRMsetting', compact('company'));
    }

    function updateCOmpanyInfo(Request $request)
    {
        $company = Company::first(); 

        $company->Comp_Name = $request->input('Comp_Name');
        $company->Comp_Address = $request->input('Comp_Address');
        $company->Comp_State = $request->input('Comp_State');
        $company->Comp_Country = $request->input('Comp_Country');
        $company->Comp_Email = $request->input('Comp_Email');
        $company->Comp_Phone = $request->input('Comp_Phone');
        $company->Comp_Website = $request->input('Comp_Website');
        $company->Comp_Tax_Number = $request->input('Comp_Tax_Number');
        $company->Comp_Vat_Number = $request->input('Comp_Vat_Number');
        $company->Comp_Reg_Number = $request->input('Comp_Reg_Number');

        $company->save();

        return redirect()->back()->with('success', 'Company information updated successfully.');
    }
}
