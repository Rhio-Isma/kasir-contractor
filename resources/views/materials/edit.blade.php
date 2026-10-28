@extends('layouts.app')

@section('title', 'Edit Material')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="fw-bold">Edit Material</h2>
        <p class="text-muted">
            Perbarui identitas dan pengaturan material.
        </p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('materials.update', $material) }}"
                method="POST">
                @csrf
                @method('PUT')

                @include('materials._form', [
                    'material' => $material,
                    'submitLabel' => 'Perbarui Material'
                ])
            </form>
        </div>
    </div>
</div>
@endsection