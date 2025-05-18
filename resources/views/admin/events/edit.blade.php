@extends('layouts.admin')

@section('title', 'Edit Event / Loker Umum')
@section('page-title', 'Edit Event / Loker Umum')

@section('content')
 <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit: {{ $event->title }}</h1>
    </div>

    <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.events._form', ['event' => $event])
    </form>
</div>
@endsection