@extends('layouts.app')

@section('title', 'Data Gudang')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Data Gudang</h2>
            <p class="text-muted mb-0">
                Kelola gudang penyimpanan material konstruksi.
            </p>
        </div>

        <a href="{{ route('warehouses.create') }}"
            class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Gudang
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
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            Periksa kembali data yang dimasukkan.
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('warehouses.index') }}"
                class="row g-2 mb-3">
                <div class="col-md-5">
                    <input type="text" name="search"
                        class="form-control"
                        value="{{ $search }}"
                        placeholder="Cari kode, nama, atau alamat gudang...">
                </div>

                <div class="col-auto">
                    <button type="submit"
                        class="btn btn-outline-primary">
                        <i class="bi bi-search"></i> Cari
                    </button>

                    <a href="{{ route('warehouses.index') }}"
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
                            <th>Kode Gudang</th>
                            <th>Nama Gudang</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($warehouses as $warehouse)
                            <tr>
                                <td>
                                    {{ $warehouses->firstItem() + $loop->index }}
                                </td>
                                <td>
                                    <span class="fw-semibold">
                                        {{ $warehouse->code }}
                                    </span>
                                </td>
                                <td>{{ $warehouse->name }}</td>
                                <td>{{ $warehouse->address ?: '-' }}</td>
                                <td>
                                    @if($warehouse->is_active)
                                        <span class="badge bg-success">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            Tidak Aktif
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('warehouses.edit', $warehouse) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>

                                    <form
                                        action="{{ route('warehouses.destroy', $warehouse) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus gudang ini?')">
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
                                <td colspan="6"
                                    class="text-center text-muted py-4">
                                    Belum ada data gudang.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $warehouses->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection