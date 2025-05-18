<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application; // Model Application
use App\Models\Vacancy;     // Model Vacancy (untuk filter)
use App\Models\User;       // Model User (untuk filter)
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the applications.
     * Menampilkan daftar pendaftaran.
     */
    public function index(Request $request)
    {
        // Query dasar dengan eager loading relasi yang kompleks
        $query = Application::with([
                        'user:id,name,email', // Hanya ambil kolom id, name, email dari user
                        'user.studentProfile:user_id,nim,major', // Ambil nim, major dari profile
                        'vacancy:id,title,company_id', // Ambil id, title, company_id dari vacancy
                        'vacancy.company:id,name' // Ambil id, name dari company terkait vacancy
                    ]);

        // --- Filtering ---
        // Filter by Status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by Vacancy
        if ($request->filled('vacancy_id')) {
            $query->where('vacancy_id', $request->vacancy_id);
        }

        // Filter by Student (Nama, Email, NIM)
         if ($request->filled('student_search')) {
             $searchTerm = $request->student_search;
             $query->whereHas('user', function ($userQuery) use ($searchTerm) {
                 $userQuery->where('name', 'like', "%{$searchTerm}%")
                           ->orWhere('email', 'like', "%{$searchTerm}%")
                           ->orWhereHas('studentProfile', function ($profileQuery) use ($searchTerm) {
                               $profileQuery->where('nim', 'like', "%{$searchTerm}%");
                           });
             });
         }
        // --- End Filtering ---

        $applications = $query->latest('application_date')->paginate(20);

        // Data untuk dropdown filter
        $vacancies = Vacancy::where('type', 'kerjasama')->orderBy('title')->pluck('title', 'id');
        $statuses = ['pending' => 'Pending', 'reviewed' => 'Reviewed', 'accepted' => 'Accepted', 'rejected' => 'Rejected', 'cancelled' => 'Cancelled'];


        return view('admin.applications.index', compact('applications', 'vacancies', 'statuses'));
    }

    /**
     * Display the specified application.
     * Menampilkan detail pendaftaran.
     */
    public function show(Application $application)
    {
         // Load relasi yang lebih detail jika belum ada di query index
         $application->loadMissing([
            'user.studentProfile', // Load semua data profile
            'vacancy.company' // Load semua data company
         ]);

        return view('admin.applications.show', compact('application'));
    }

    /**
     * Update the status of the specified application.
     * Mengubah status pendaftaran.
     */
    public function updateStatus(Request $request, Application $application)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['pending', 'reviewed', 'accepted', 'rejected', 'cancelled'])],
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $application->update([
            'status' => $validated['status'],
            'admin_notes' => $validated['admin_notes'],
        ]);

        // Redirect kembali ke halaman sebelumnya
        return redirect()->back()->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

     /**
      * Remove the specified resource from storage. (Opsional)
      * Menghapus data pendaftaran.
      */
}