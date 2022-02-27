<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Company\CreateCompanyRequest;
use App\Http\Requests\Admin\Company\UpdateCompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use File;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.companies.index');
    }

    public function companiesDataTable(){
        $companies = Company::get();
        return DataTables($companies)
                ->addIndexColumn()
                ->addColumn('image', function ($company) {
                    $url= asset('storage/'.$company->image);
                    return '<img src="'.$url.'" width="40" />';
                })
                ->addColumn('actions', 'admin.companies.actions')
                ->rawColumns(['actions', 'image'])
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCompanyRequest $request)
    {
        $attributes = $request->except(['image']);

        if ($request->hasFile('image')) {
            $attributes['image'] = $request->file('image')->store('companies', 'public');
        }

        Company::create($attributes);

        return redirect('companies')->with([
            'type' => 'success',
            'message' => 'Company Created Successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $attributes = $request->except(['image']);

        if ($request->hasFile('image')) {
            if (File::exists(storage_path('app/public/' . $company->image))) {
                File::delete(storage_path('app/public/' . $company->image));
            }
            $attributes['image'] = $request->file('image')->store('companies', 'public');
        }

        $company->update($attributes);

        return redirect('companies')->with([
            'type' => 'success',
            'message' => 'Company Updated Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        if (File::exists(storage_path('app/public/' . $company->image))) {
            File::delete(storage_path('app/public/' . $company->image));
        }

        $company->delete();

        return redirect('companies')->with([
            'type' => 'error',
            'message' => 'Company Deleted Successfully'
        ]);
    }

    
}
