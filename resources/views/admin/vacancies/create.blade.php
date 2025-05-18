@extends('layouts.admin')

@section('title', 'Tambah Lowongan Kerjasama Baru')
@section('page-title', 'Tambah Lowongan Kerjasama')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Lowongan Kerjasama Baru</h1>
    </div>

    <form action="{{ route('admin.vacancies.store') }}" method="POST">
        @csrf
        {{-- Masukkan partial form --}}
        {{-- Kirim variabel $companies ke partial --}}
        @include('admin.vacancies._form', ['companies' => $companies])
    </form>
</div>
@endsection