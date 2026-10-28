@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
<div class="mb-4">
    <h1 class="page-title mb-1">Edit Kategori Material</h1>
    <p class="text-secondary small mb-0">
        Perbarui informasi kategori yang dipilih.
    </p>
</div>

<div class="panel" style="max-width: 760px;">
    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        @include('categories._form', [
            'category' => $category,
            'submitLabel' => 'Simpan Perubahan'
        ])
    </form>
</div>
@endsection
