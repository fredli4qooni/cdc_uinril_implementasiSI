@extends('layouts.admin')

@section('title', 'Edit Perusahaan Mitra')
@section('page-title', 'Edit Perusahaan')

@section('content')
 <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Perusahaan: {{ $company->name }}</h1>
    </div>

    <form action="{{ route('admin.companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
        @csrf {{-- Token CSRF Wajib --}}
        @method('PUT') {{-- Method Spoofing untuk Update --}}

        {{-- Masukkan partial form, kirim data $company --}}
        @include('admin.companies._form', ['company' => $company])

    </form>
</div>
@endsection