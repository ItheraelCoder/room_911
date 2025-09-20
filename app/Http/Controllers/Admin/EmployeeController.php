<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class EmployeeController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = Employee::with('department');
        
        if($request->filled('search')){
            $query->where('internal_id', $request->input('search'))
                ->orWhere('first_name', 'like', '%' . $request->input('search') . '%')
                ->orWhere('last_name', 'like', '%' . $request->input('search') . '%');
        }


        if($request->filled('department_id')){
            $query->where('department_id',$request->input('department_id'));
        }

        $employees = $query->paginate(10);
        $departments = Department::all();

        return view('admin.dashboard',compact('employees','departments'));
    }

    public function store(Request $request)
    {
        $request -> validate([
            'internal_id' => 'required|integer|unique:employees,internal_id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'has_access' => 'boolean',
        ]);

        Employee::create($request->all());

        return redirect()->route('admin.dashboard')->with('success','Employee registered.');
    }


    public function show(Employee $employee)
    {
        return view('admin.employees.show',compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $departments = Department::all();
        return view('admin.employees.edit', compact('employee', 'departments'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'has_access' => 'boolean',
        ]);

        $employee->update($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Información del empleado actualizada.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Empleado eliminado correctamente.');
    }

    public function showHistory(Employee $employee, Request $request)
    {
        $query = $employee->accessLogs();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('access_time', [$request->input('start_date'), $request->input('end_date') . ' 23:59:59']);
        }

        $accessLogs = $query->orderBy('access_time', 'desc')->get();

        return view('admin.employees.history', compact('employee', 'accessLogs'));
    }

    public function downloadHistoryPdf(Employee $employee, Request $request)
    {
        $query = $employee->accessLogs();
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('access_time', [$request->input('start_date'), $request->input('end_date') . ' 23:59:59']);
        }
        $accessLogs = $query->orderBy('access_time', 'desc')->get();

        $pdf = Pdf::loadView('pdf.employee_history', compact('employee', 'accessLogs'));
        return $pdf->download('historial_acceso_' . $employee->internal_id . '.pdf');
    }


    public function create()
    {
        $departments = Department::all();
        return view('admin.employees.create', compact('departments'));
    }
    
}
