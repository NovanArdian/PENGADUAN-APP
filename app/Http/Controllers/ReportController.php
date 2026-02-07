<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\ReportsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();
        
        if ($user->role === 'STAFF') {
            $staffProvince = $user->staffProvinces()->first();
            if (!$staffProvince) {
                return redirect()->back()->with('error', 'Staff belum memiliki provinsi yang ditugaskan.');
            }
            
            $reports = Report::where('province', $staffProvince->province)
                           ->orderBy('created_at', 'desc')
                           ->with('responses')
                           ->get();
        } else {
            $reports = Report::orderBy('created_at', 'desc')->with('responses')->get();
        }

        return view('reports.report', compact('reports'));
    }

    public function create()
    {
        return view('reports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'description' => 'required|string|max:1000',
                'type'        => 'required|in:KEJAHATAN,PEMBANGUNAN,SOSIAL',
                'province'    => 'required|string|max:255',
                'regency'     => 'required|string|max:255',
                'subdistrict' => 'required|string|max:255',
                'village'     => 'required|string|max:255',
                'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->with('error', 'Data tidak valid. Periksa kembali form Anda.')->withInput();
        }

        $report = new Report();
        $report->user_id = Auth::id();
        $report->description = $validated['description'];
        $report->type = $validated['type'];
        $report->province = $validated['province'];
        $report->regency = $validated['regency'];
        $report->subdistrict = $validated['subdistrict'];
        $report->village = $validated['village'];
        $report->voting = 0;
        $report->viewers = 0;

        if ($request->hasFile('image')) {
            $report->image = $request->file('image')->store('reports', 'public');
        }

        $report->save();

        return redirect()->back()->with('success', 'Laporan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $report = Report::with('comments')->findOrFail($id);
        $report->viewers += 1;
        $report->save();

        return view('reports.show', compact('report'));
    }

    /**
     * Menyimpan komentar pada pengaduan.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeComment(Request $request, $id)
    {
        try {
            $request->validate([
                'comment' => 'required|string|max:500',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->with('error', 'Komentar tidak boleh kosong atau terlalu panjang.');
        }

        $report = Report::findOrFail($id);

        Comment::create([
            'report_id' => $report->id,
            'comment' => $request->comment,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('report.show', $id)->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function myReports()
    {
        /** @var User $user */
        $user = auth()->user();
        $reports = Report::where('user_id', $user->id)->with('responses')->get();

        return view('reports.monitoring', compact('reports'));
    }

    public function destroy(string $id)
    {
        $report = Report::findOrFail($id);
        $report->delete();

        return redirect()->route('report.data-report')->with('success', 'Laporan berhasil dihapus.');
    }

    public function vote($id)
    {
        $report = Report::findOrFail($id);
        $report->voting += 1;
        $report->save();

        return redirect()->back()->with('success', 'Vote berhasil ditambahkan.');
    }

    public function unvote($id)
    {
        $report = Report::findOrFail($id);
        $report->voting -= 1;
        if ($report->voting < 0) {
            $report->voting = 0;
        }
        $report->save();

        return redirect()->back()->with('success', 'Vote berhasil dihapus.');
    }

    public function export(Request $request)
    {
        $fileName = 'report.' . now()->format('Y-m-d') . '.xlsx';

        return Excel::download(new ReportsExport($request), $fileName);
    }
}
