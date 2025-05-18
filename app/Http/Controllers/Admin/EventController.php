<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event; // Model Event
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Untuk file image
use Illuminate\Validation\Rule;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menampilkan daftar event/loker umum.
     */
    public function index()
    {
        $events = Event::latest()->paginate(15); // Ambil data terbaru
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     * Menampilkan form tambah event/loker.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     * Menyimpan event/loker baru.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => ['required', Rule::in(['event', 'loker_umum'])],
            'source_url' => 'nullable|url|max:2048',
            'start_datetime' => 'nullable|date',
            'end_datetime' => 'nullable|date|after_or_equal:start_datetime', // Harus setelah atau sama dengan tanggal mulai
            'location' => 'nullable|string|max:255',
            'organizer' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
            'is_published' => 'required|boolean',
        ]);

        // Handle Image Upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/events', 'public'); // Simpan di storage/app/public/images/events
        }

        // Siapkan data untuk disimpan
        $eventData = $validatedData;
        $eventData['image_path'] = $imagePath;
        unset($eventData['image']); // Hapus key 'image' karena sudah diproses

        Event::create($eventData);

        return redirect()->route('admin.events.index')
                         ->with('success', 'Event/Loker Umum berhasil ditambahkan.');
    }

    /**
     * Display the specified resource. (Opsional)
     */
    public function show(Event $event)
    {
        return view('admin.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     * Menampilkan form edit event/loker.
     */
    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     * Mengupdate event/loker.
     */
    public function update(Request $request, Event $event)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => ['required', Rule::in(['event', 'loker_umum'])],
            'source_url' => 'nullable|url|max:2048',
            'start_datetime' => 'nullable|date',
            'end_datetime' => 'nullable|date|after_or_equal:start_datetime',
            'location' => 'nullable|string|max:255',
            'organizer' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_published' => 'required|boolean',
        ]);

        // Handle Image Update
        $imagePath = $event->image_path; // Default ke gambar lama
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($event->image_path && Storage::disk('public')->exists($event->image_path)) {
                Storage::disk('public')->delete($event->image_path);
            }
            // Upload gambar baru
            $imagePath = $request->file('image')->store('images/events', 'public');
        } elseif ($request->boolean('remove_image')) { // Opsi hapus gambar
             if ($event->image_path && Storage::disk('public')->exists($event->image_path)) {
                Storage::disk('public')->delete($event->image_path);
            }
            $imagePath = null;
        }

        // Siapkan data untuk diupdate
        $updateData = $validatedData;
        $updateData['image_path'] = $imagePath;
        unset($updateData['image'], $updateData['remove_image']); // Hapus key temporary

        $event->update($updateData);

        return redirect()->route('admin.events.index')
                         ->with('success', 'Event/Loker Umum berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     * Menghapus event/loker.
     */
    public function destroy(Event $event)
    {
        // Hapus gambar jika ada
        if ($event->image_path && Storage::disk('public')->exists($event->image_path)) {
            Storage::disk('public')->delete($event->image_path);
        }

        $event->delete();

        return redirect()->route('admin.events.index')
                         ->with('success', 'Event/Loker Umum berhasil dihapus.');
    }
}