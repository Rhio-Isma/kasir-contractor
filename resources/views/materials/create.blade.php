@extends('layouts.app')

@section('title', 'Tambah Material')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="fw-bold">Tambah Material</h2>
        <p class="text-muted">
            Masukkan identitas dan pengaturan stok minimum material.
        </p>
    </div>

    @if($categories->isEmpty())
        <div class="alert alert-warning">
            Belum ada kategori aktif. Tambahkan kategori terlebih dahulu
            sebelum membuat material.
            <a href="{{ route('categories.create') }}">
                Tambah kategori
            </a>
        </div>
    @endif

    @if($units->isEmpty())
        <div class="alert alert-warning">
            Belum ada satuan. Tambahkan satuan terlebih dahulu.
            <a href="{{ route('units.create') }}">Tambah satuan</a>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('materials.store') }}" method="POST">
                @csrf

                @include('materials._form', [
                    'submitLabel' => 'Simpan Material'
                ])
            </form>
        </div>
    </div>
</div>
@endsection