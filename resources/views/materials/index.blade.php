@extends('layouts.app')

@section('title', 'Data Material')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Data Material</h2>
            <p class="text-muted mb-0">
                Kelola material konstruksi dan batas stok minimum.
            </p>
        </div>

        <a href="{{ route('materials.create') }}"
            class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Material
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
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('materials.index') }}"
                class="row g-2 mb-3">
                <div class="col-md-4">
                    <input type="text" name="search"
                        class="form-control"
                        value="{{ $search }}"
                        placeholder="Cari kode atau nama material...">
                </div>

                <div class="col-md-3">
                    <select name="category_id" class="form-select">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                @selected((string) $categoryId === (string) $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="1" @selected($status === '1')>
                            Aktif
                        </option>
                        <option value="0" @selected($status === '0')>
                            Tidak Aktif
                        </option>
                    </select>
                </div>

                <div class="col-auto">
                    <button type="submit"
                        class="btn btn-outline-primary">
                        <i class="bi bi-search"></i> Cari
                    </button>
                    <a href="{{ route('materials.index') }}"
                        class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>Kode</th>
                            <th>Nama Material</th>
                            <th>Kategori</th>
                            <th>Satuan</th>
                            <th>Stok Minimum</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($materials as $material)
                            <tr>
                                <td>
                                    {{ $materials->firstItem() + $loop->index }}
                                </td>
                                <td class="fw-semibold">
                                    {{ $material->code }}
                                </td>
                                <td>{{ $material->name }}</td>
                                <td>
                                    {{ $material->category->name ?? '-' }}
                                </td>
                                <td>
                                    {{ $material->unit->symbol ?? '-' }}
                                </td>
                                <td>
                                    {{ number_format((float) $material->minimum_stock, 2, ',', '.') }}
                                    {{ $material->unit->symbol ?? '' }}
                                </td>
                                <td>
                                    @if($material->is_active)
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
                                    <a href="{{ route('materials.edit', $material) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>

                                    <form
                                        action="{{ route('materials.destroy', $material) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus material ini?')">
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
                                <td colspan="8"
                                    class="text-center text-muted py-4">
                                    Belum ada data material.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $materials->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection