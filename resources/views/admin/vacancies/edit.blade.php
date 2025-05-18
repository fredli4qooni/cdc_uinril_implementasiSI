@extends('layouts.admin')

@section('title', 'Edit Lowongan Kerjasama')
@section('page-title', 'Edit Lowongan')

@section('content')
 <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Lowongan: {{ $vacancy->title }}</h1>
    </div>

    <form action="{{ route('admin.vacancies.update', $vacancy->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Masukkan partial form --}}
        {{-- Kirim variabel $vacancy dan $companies ke partial --}}
        @include('admin.vacancies._form', ['vacancy' => $vacancy, 'companies' => $companies])
    </form>
</div>
@endsection