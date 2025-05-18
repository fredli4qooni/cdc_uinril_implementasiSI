<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Event; // Import model Event
use Illuminate\Http\Request;
use Illuminate\View\View; // Import View

class EventController extends Controller
{
    /**
     * Display a listing of published events and general job listings.
     * Menampilkan daftar event/loker umum yang sudah dipublikasikan.
     */
    public function index(Request $request)
    {
        // Query dasar: ambil event/loker yang is_published = true
        $query = Event::where('is_published', true)
                      // Optional: filter agar event yang sudah lewat tidak tampil teratas
                      // ->where(function($q){
                      //      $q->whereNull('end_datetime') // Tampilkan jika tidak ada tgl selesai
                      //       ->orWhere('end_datetime', '>=', now()); // Atau jika belum lewat
                      // })
                      ;

        // --- Fitur Pencarian/Filter (Contoh) ---
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('location', 'like', "%{$searchTerm}%")
                  ->orWhere('organizer', 'like', "%{$searchTerm}%");
            });
        }
         if ($request->filled('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }
        // --- Akhir Fitur Pencarian ---

        // Urutkan berdasarkan tanggal mulai (jika ada, yang terbaru/mendatang di atas)
        // atau tanggal dibuat jika tanggal mulai null
        $events = $query->orderByRaw('CASE WHEN start_datetime IS NULL THEN created_at ELSE start_datetime END DESC')
                       ->paginate(12); // Paginasi (misal 12 untuk layout 3 atau 4 kolom)

        return view('mahasiswa.events.index', compact('events'));
    }

    public function show(Event $event): View // Gunakan Route Model Binding
    {
        // 1. Pastikan event/loker sudah dipublikasikan
        if (!$event->is_published) {
            // Jika belum publish, mahasiswa tidak boleh lihat
            abort(404);
        }

        // 2. Kirim data event ke view
        return view('mahasiswa.events.show', compact('event'));
    }
}