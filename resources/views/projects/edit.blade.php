@extends('layouts.app')

@section('title', 'Edit Proyek')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="fw-bold">Edit Proyek</h2>
        <p class="text-muted">
            Perbarui informasi proyek konstruksi.
        </p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('projects.update', $project) }}"
                method="POST">
                @csrf
                @method('PUT')

                @include('projects._form', [
                    'project' => $project,
                    'submitLabel' => 'Perbarui Proyek'
                ])
            </form>
        </div>
    </div>
</div>
@endsection