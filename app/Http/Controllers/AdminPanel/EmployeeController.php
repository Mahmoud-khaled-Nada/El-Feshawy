<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\EmployeeCreateRequest;
use App\Http\Requests\AdminPanel\EmployeeUpdateRequest;
use App\Http\Traits\FileUpload;
use App\Models\Employee;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    use FileUpload;
    public function __construct()
    {
        $this->middleware('permission:view employees')->only('index');
        $this->middleware('permission:update employees')->only('edit', 'update');
        $this->middleware('permission:delete employees')->only('destroy');
        $this->middleware('permission:create employees')->only('create', 'store', 'import', 'importSave');
    }
    public function index()
    {
        $employees = Employee::all();

        return view('AdminPanel.employees.index', get_defined_vars());
    }


    public function create()
    {
        return view('AdminPanel.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeCreateRequest $request)
    {
        $data = $request->validated();
        $data['code'] =  uniqid('SSA-');

         Employee::create($data);
        flashy()->success(__('lang.created'));
        return redirect()->route('employees.index');
    }



    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);

        return view('AdminPanel.employees.edit', get_defined_vars());
    }


    public function update(EmployeeUpdateRequest $request, string $id)
    {
        $employee = Employee::findOrFail($id);

        $employee->update($request->validated());

        flashy()->success(__('lang.updated'));
        return redirect()->route('employees.index');
    }


    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);
        $message = $employee->status == '1' ? __('lang.deleted') : __('lang.activated');
        $employee->status = $employee->status == '1' ? '0' : '1';
        $employee->save();
        flashy()->success($message);
        return redirect()->route('employees.index');
    }

    public function import()
    {
        return view('AdminPanel.employees.import');
    }

    public function importSave(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::queueImport(new \App\Imports\EmployeeImport(), $request->file('file'));
        flashy()->success(__('lang.imported'));
        return redirect()->route('employees.index');
    }

}
