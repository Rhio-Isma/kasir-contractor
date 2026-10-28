@extends('layouts.app')

@section('title', 'Tambah Satuan Material')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="fw-bold">Tambah Satuan Material</h2>
        <p class="text-muted">Masukkan nama dan simbol satuan.</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('units.store') }}" method="POST">
                @csrf

                @include('units._form', [
                    'submitLabel' => 'Simpan Satuan'
                ])
            </form>
        </div>
    </div>
</div>
@endsection