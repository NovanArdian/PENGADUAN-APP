<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Response;
use App\Models\Report;
use App\Models\ResponseProgress;
use App\Models\User;

class ResponseController extends Controller
{
    /**
     * Display a listing of the responses.
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
            
            $reports = Report::where('province', $staffProvince->province)->get();
        } else {
            $reports = Report::all();
        }
        
        return view('response.index', compact('reports'));
    }

    /**
     * Store a newly created response in storage.
     */
    public function store(Request $request, string $id)
    {
        /** @var User $user */
        $user = auth()->user();
        $report = Report::findOrFail($id);
        
        if ($user->role === 'STAFF') {
            $staffProvince = $user->staffProvinces()->first();
            if (!$staffProvince || $report->province !== $staffProvince->province) {
                return redirect()->back()->with('error', 'Anda tidak memiliki akses ke laporan ini.');
            }
        }
        
        try {
            $request->validate([
                'response_status' => 'required|in:REJECT,ON_PROCESS',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->with('error', 'Status tanggapan tidak valid.');
        }

        Response::create([
            'report_id' => $id,
            'staff_id' => $user->id,
            'response_status' => $request->response_status,
        ]);

        return redirect()->back()->with('success', 'Tanggapan berhasil ditambahkan.');
    }

    public function storeProgress(Request $request, string $id)
    {
        try {
            $request->validate([
                'histories' => 'required|string|max:1000',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->with('error', 'Progress tidak boleh kosong atau terlalu panjang.');
        }

        ResponseProgress::create([
            'response_id' => $id,
            'histories' => $request->histories,
        ]);

        return redirect()->back()->with('success', 'Tanggapan berhasil ditambahkan.');
    }

    /**
     * Display the specified response.
     */
    public function show(string $id)
    {
        /** @var User $user */
        $user = auth()->user();
        $response = Response::with('report', 'progress')->findOrFail($id);
        
        if ($user->role === 'STAFF') {
            $staffProvince = $user->staffProvinces()->first();
            if (!$staffProvince || $response->report->province !== $staffProvince->province) {
                return redirect()->back()->with('error', 'Anda tidak memiliki akses ke tanggapan ini.');
            }
        }

        return view('response.show', compact('response'));
    }

    /**
     * Update the specified response in storage.
     */
    public function update(Request $request, string $id)
    {
        $response = Response::findOrFail($id);
        $response->update([
            'response_status' => $request->response_status,
        ]);

        return redirect()->back()->with('success', 'Tanggapan berhasil diperbarui.');
    }

    /**
     * Remove the specified response from storage.
     */
    public function destroy(string $id)
    {
        $progress = ResponseProgress::findOrFail($id);
        $progress->delete();

        return redirect()->back()->with('success', 'Progress berhasil dihapus.');
    }
}
