@extends('layouts.admin')

@section('title', 'Edit Data Mahasiswa')
@section('page-title', 'Edit Mahasiswa')

@section('content')
 <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Mahasiswa: {{ $student->name }}</h1>
    </div>

    {{-- Asumsikan student profile selalu ada karena validasi di controller --}}
    @if($student->studentProfile)
        <form action="{{ route('admin.students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.students._form', ['student' => $student])
        </form>
    @else
        <div class="alert alert-danger">
            Profil untuk mahasiswa ini tidak ditemukan. Silakan hubungi administrator sistem.
             <a href="{{ route('admin.students.index') }}" class="btn btn-secondary mt-2">Kembali</a>
        </div>
    @endif
</div>
@endsection