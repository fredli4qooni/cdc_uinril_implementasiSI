<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View; // Import View

class BookmarkController extends Controller
{
    /**
     * Display a listing of the student's bookmarked vacancies.
     * Menampilkan daftar lowongan yang disimpan oleh mahasiswa yang login.
     */
    public function index(): View
    {
        $user = Auth::user();

        // Ambil semua lowongan yang di-bookmark oleh user ini
        // Gunakan relasi bookmarkedVacancies() yang sudah kita buat di model User
        $bookmarkedVacancies = $user->bookmarkedVacancies()
                                    ->where('status', 'open') // Hanya tampilkan yang masih open
                                    ->where(function ($q) { // Dan belum lewat deadline
                                        $q->whereNull('deadline')
                                          ->orWhere('deadline', '>=', now()->format('Y-m-d'));
                                    })
                                    ->with('company:id,name,logo_path') // Eager load company
                                    ->latest('bookmarks.created_at') // Urutkan berdasarkan kapan di-bookmark
                                    ->paginate(9); // Paginasi

        return view('mahasiswa.bookmarks.index', compact('bookmarkedVacancies'));
    }
}