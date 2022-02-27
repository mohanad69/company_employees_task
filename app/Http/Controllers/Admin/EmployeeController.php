<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Employee\CreateEmployeeRequest;
use App\Http\Requests\Admin\Employee\UpdateEmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use File;
use App\Notifications\EmployeeGreeting;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::select('id', 'name')->get();
        return view('admin.employees.index', compact('companies'));
    }

    public function employeesDataTable(Request $request){
        $employees = Employee::select('*');
        return DataTables($employees)
                ->addIndexColumn()
                ->addColumn('image', function ($employee) {
                    $url= asset('storage/'.$employee->image);
                    return '<img src="'.$url.'" width="40" />';
                })
                ->addColumn('company', function ($employee) {
                    return $employee->company->name;
                })
                ->addColumn('actions', 'admin.employees.actions')
                ->filter(function ($instance) use ($request) {
                    if ($request->get('company') && $request->get('company') != 0) {
                        $instance->where('company_id', $request->get('company'));
                    }
                    if (!empty($request->get('search'))) {
                        $instance->where(function($w) use($request){
                            $search = $request->get('search');
                            $w->orWhere('name', 'LIKE', "%$search%")
                            ->orWhere('email', 'LIKE', "%$search%")
                            ->orWhere('address', 'LIKE', "%$search%");
                        });
                    }
                })
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
        $companies = Company::select('id', 'name')->get();
        return view('admin.employees.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEmployeeRequest $request)
    {
        $attributes = $request->except(['image', 'password']);

        if ($request->hasFile('image')) {
            $attributes['image'] = $request->file('image')->store('employees', 'public');
        }
        
        $attributes['password'] = \bcrypt($request->password);

        $employee = Employee::create($attributes);

        $employee->notify(new EmployeeGreeting());

        return redirect('employees')->with([
            'type' => 'success',
            'message' => 'Employee Created Successfully'
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
    public function edit(Employee $employee)
    {
        $companies = Company::select('id', 'name')->get();
        return view('admin.employees.edit', compact('companies', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $attributes = $request->except(['image', 'password']);

        if ($request->hasFile('image')) {
            if (File::exists(storage_path('app/public/' . $employee->image))) {
                File::delete(storage_path('app/public/' . $employee->image));
            }
            $attributes['image'] = $request->file('image')->store('employees', 'public');
        }

        if($request->password){
            $attributes['password'] = \bcrypt($request->password);
        }

        $employee->update($attributes);

        return redirect('employees')->with([
            'type' => 'success',
            'message' => 'Employee Updated Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        if (File::exists(storage_path('app/public/' . $employee->image))) {
            File::delete(storage_path('app/public/' . $employee->image));
        }

        $employee->delete();

        return redirect('employees')->with([
            'type' => 'error',
            'message' => 'Employee Deleted Successfully'
        ]);
    }
}
