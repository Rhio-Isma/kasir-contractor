@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
<div class="mb-4">
    <h1 class="page-title mb-1">Tambah Kategori Material</h1>
    <p class="text-secondary small mb-0">
        Masukkan informasi kategori material baru.
    </p>
</div>

<div class="panel" style="max-width: 760px;">
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        @include('categories._form', [
            'submitLabel' => 'Simpan Kategori'
        ])
    </form>
</div>
@endsection
