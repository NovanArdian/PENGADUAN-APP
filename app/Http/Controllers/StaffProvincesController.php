<?php

namespace App\Http\Controllers;

use App\Models\Response;
use App\Models\Report;
use App\Models\User;

class StaffProvincesController extends Controller
{
    public function chart()
    {
        /** @var User $user */
        $user = auth()->user();
        
        if ($user->role === 'STAFF') {
            $staffProvince = $user->staffProvinces()->first();
            if (!$staffProvince) {
                return redirect()->back()->with('error', 'Staff belum memiliki provinsi yang ditugaskan.');
            }
            
            $report = Report::where('province', $staffProvince->province)->get();
            $response = Response::whereHas('report', function($query) use ($staffProvince) {
                $query->where('province', $staffProvince->province);
            })->get();
        } else {
            $report = Report::all();
            $response = Response::all();
        }

        $report_count = count($report);
        $response_count = count($response);

        return view('chart', compact('report_count', 'response_count'));
    }
}
