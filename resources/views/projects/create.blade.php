@extends('layouts.app')

@section('title', 'Tambah Proyek')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="fw-bold">Tambah Proyek</h2>
        <p class="text-muted">
            Masukkan informasi proyek konstruksi baru.
        </p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('projects.store') }}" method="POST">
                @csrf

                @include('projects._form', [
                    'submitLabel' => 'Simpan Proyek'
                ])
            </form>
        </div>
    </div>
</div>
@endsection