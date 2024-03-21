<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Http\Requests\CompanyRequest;

class CompanyController extends Controller
{
    public function index()
    {
        $company = Company::first();

        return view('admin.company.index', compact('company'));
    }

    public function edit(Company $company)
    {

        // $company = Company::all();

        return view('admin.company.edit', compact('company'));

    }

    public function update(CompanyRequest $request, Company $company)
    {

        $company->name = $request->input('name');
        $company->postal_code = $request->input('postal_code');
        $company->address = $request->input('address');
        $company->representative = $request->input('representative');
        $company->establishment_date = $request->input('establishment_date');
        $company->capital = $request->input('capital');
        $company->business = $request->input('business');
        $company->number_of_employees = $request->input('number_of_employees');
        $company->save();
 
        return redirect()->route('admin.company.index', $company)->with('flash_message', '会社概要を編集しました。');
    }
}
