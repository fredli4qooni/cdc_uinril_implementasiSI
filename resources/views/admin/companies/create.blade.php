@extends('layouts.admin')

@section('title', 'Tambah Perusahaan Mitra Baru')
@section('page-title', 'Tambah Perusahaan')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Perusahaan Mitra Baru</h1>
    </div>

    <form action="{{ route('admin.companies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf {{-- Token CSRF Wajib --}}

        {{-- Masukkan partial form --}}
        @include('admin.companies._form')

    </form>
</div>
@endsection