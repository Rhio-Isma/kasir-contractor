@extends('layouts.app')

@section('title', 'Data Proyek')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Data Proyek</h2>
            <p class="text-muted mb-0">
                Kelola proyek konstruksi dan anggaran pekerjaan.
            </p>
        </div>

        <a href="{{ route('projects.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Proyek
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close"
                data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('projects.index') }}"
                class="row g-2 mb-3">
                <div class="col-md-5">
                    <input type="text" name="search"
                        class="form-control"
                        value="{{ $search }}"
                        placeholder="Cari kode, nama proyek, atau klien...">
                </div>

                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="planning"
                            @selected($status === 'planning')>
                            Perencanaan
                        </option>
                        <option value="ongoing"
                            @selected($status === 'ongoing')>
                            Berjalan
                        </option>
                        <option value="completed"
                            @selected($status === 'completed')>
                            Selesai
                        </option>
                        <option value="cancelled"
                            @selected($status === 'cancelled')>
                            Dibatalkan
                        </option>
                    </select>
                </div>

                <div class="col-auto">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-search"></i> Cari
                    </button>
                    <a href="{{ route('projects.index') }}"
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
                            <th>Kode Proyek</th>
                            <th>Nama Proyek</th>
                            <th>Klien</th>
                            <th>Anggaran</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($projects as $project)
                            <tr>
                                <td>
                                    {{ $projects->firstItem() + $loop->index }}
                                </td>
                                <td class="fw-semibold">
                                    {{ $project->code }}
                                </td>
                                <td>
                                    <div class="fw-semibold">
                                        {{ $project->name }}
                                    </div>
                                    <small class="text-muted">
                                        {{ $project->location ?: 'Lokasi belum diisi' }}
                                    </small>
                                </td>
                                <td>{{ $project->client_name ?: '-' }}</td>
                                <td>
                                    Rp {{ number_format((float) $project->budget, 0, ',', '.') }}
                                </td>
                                <td>
                                    @switch($project->status)
                                        @case('planning')
                                            <span class="badge bg-info text-dark">
                                                Perencanaan
                                            </span>
                                            @break
                                        @case('ongoing')
                                            <span class="badge bg-primary">
                                                Berjalan
                                            </span>
                                            @break
                                        @case('completed')
                                            <span class="badge bg-success">
                                                Selesai
                                            </span>
                                            @break
                                        @case('cancelled')
                                            <span class="badge bg-danger">
                                                Dibatalkan
                                            </span>
                                            @break
                                    @endswitch
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('projects.edit', $project) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>

                                    <form
                                        action="{{ route('projects.destroy', $project) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus proyek ini?')">
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
                                <td colspan="7"
                                    class="text-center text-muted py-4">
                                    Belum ada data proyek.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $projects->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection