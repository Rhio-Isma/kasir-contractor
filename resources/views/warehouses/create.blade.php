@extends('layouts.app')

@section('title', 'Tambah Gudang')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="fw-bold">Tambah Gudang</h2>
        <p class="text-muted">
            Masukkan informasi gudang penyimpanan material.
        </p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('warehouses.store') }}"
                method="POST">
                @csrf

                @include('warehouses._form', [
                    'submitLabel' => 'Simpan Gudang'
                ])
            </form>
        </div>
    </div>
</div>
@endsection