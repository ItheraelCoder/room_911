<?php

namespace App\Http\Controllers;

use App\Models\AccessLog;
use App\Models\Employee;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    //
    public function showAccessForm()
    {
        // return 'access simulator';
        return view('access_simulator');
    }

    public function handleAccess(Request $request)
    {
        $request->validate([
            'internal_id' => 'required|integer',
        ]);

        $employee = Employee::where('internal_id', $request->input('internal_id'))->first();
        $accessStatus = 'not_registered';

        if ($employee) {
            $accessStatus = $employee->has_access ? 'granted' : 'denied';
        }

        AccessLog::create([
            'employee_internal_id' => $request->input('internal_id'),
            'access_time' => now(),
            'access_status' => $accessStatus,
            'notes' => null,
        ]);

        return back()->with('status', 'Access attemp registered: ' . $accessStatus);
    }
}
