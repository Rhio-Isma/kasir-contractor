@extends('layouts.app')

@section('title', 'Edit Satuan Material')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="fw-bold">Edit Satuan Material</h2>
        <p class="text-muted">Perbarui informasi satuan material.</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('units.update', $unit) }}"
                method="POST">
                @csrf
                @method('PUT')

                @include('units._form', [
                    'unit' => $unit,
                    'submitLabel' => 'Perbarui Satuan'
                ])
            </form>
        </div>
    </div>
</div>
@endsection