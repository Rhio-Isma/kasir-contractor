@extends('layouts.app')

@section('title', 'Satuan Material')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Satuan Material</h2>
            <p class="text-muted mb-0">
                Kelola satuan material konstruksi.
            </p>
        </div>

        <a href="{{ route('units.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Satuan
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close"
                data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close"
                data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('units.index') }}"
                class="row g-2 mb-3">
                <div class="col-md-5">
                    <input type="text" name="search"
                        class="form-control"
                        value="{{ $search }}"
                        placeholder="Cari nama atau simbol satuan...">
                </div>

                <div class="col-auto">
                    <button class="btn btn-outline-primary">
                        <i class="bi bi-search"></i> Cari
                    </button>

                    <a href="{{ route('units.index') }}"
                        class="btn btn-outline-secondary">
                        Reset
                    </a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>Nama Satuan</th>
                            <th>Simbol</th>
                            <th>Jumlah Material</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($units as $unit)
                            <tr>
                                <td>
                                    {{ $units->firstItem() + $loop->index }}
                                </td>
                                <td>{{ $unit->name }}</td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        {{ $unit->symbol }}
                                    </span>
                                </td>
                                <td>{{ $unit->materials_count }}</td>
                                <td class="text-center">
                                    <a href="{{ route('units.edit', $unit) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>

                                    <form
                                        action="{{ route('units.destroy', $unit) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus satuan ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"
                                    class="text-center text-muted py-4">
                                    Belum ada data satuan material.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $units->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection