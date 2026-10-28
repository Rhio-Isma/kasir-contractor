@extends('layouts.app')

@section('title', 'Edit Gudang')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="fw-bold">Edit Gudang</h2>
        <p class="text-muted">
            Perbarui informasi gudang penyimpanan material.
        </p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('warehouses.update', $warehouse) }}"
                method="POST">
                @csrf
                @method('PUT')

                @include('warehouses._form', [
                    'warehouse' => $warehouse,
                    'submitLabel' => 'Perbarui Gudang'
                ])
            </form>
        </div>
    </div>
</div>
@endsection