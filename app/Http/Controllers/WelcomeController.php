<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $totalReports = Report::count();
        $totalProgress = Report::whereHas('responses', function($query) {
            $query->where('response_status', 'ON_PROCESS');
        })->count();
        $totalDone = Report::whereHas('responses', function($query) {
            $query->where('response_status', 'DONE');
        })->count();
        
        $recentReports = Report::with('user')
            ->latest()
            ->take(6)
            ->get();
        
        $reportsByProvince = Report::selectRaw('province, COUNT(*) as total')
            ->groupBy('province')
            ->orderByDesc('total')
            ->take(5)
            ->get();
        
        return view('welcome', compact('totalReports', 'totalProgress', 'totalDone', 'recentReports', 'reportsByProvince'));
    }

    public function allReports()
    {
        $allReports = Report::with('user')->latest()->get();
        return view('all-reports', compact('allReports'));
    }

    public function showReport($id)
    {
        $report = Report::with('comments.user')->findOrFail($id);
        $report->viewers += 1;
        $report->save();
        return view('report-detail', compact('report'));
    }
}
