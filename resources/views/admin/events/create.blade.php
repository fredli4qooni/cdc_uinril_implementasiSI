@extends('layouts.admin')

@section('title', 'Tambah Event / Loker Umum Baru')
@section('page-title', 'Tambah Event / Loker Umum')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Event / Loker Umum Baru</h1>
    </div>

    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.events._form')
    </form>
</div>
@endsection