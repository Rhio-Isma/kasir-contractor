@extends('layouts.app')

@section('title', 'Kategori Material')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h1 class="page-title mb-1">Kategori Material</h1>
        <p class="text-secondary small mb-0">
            Kelola pengelompokan material konstruksi.
        </p>
    </div>

    <a href="{{ route('categories.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="bi bi-exclamation-circle me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        Terdapat input yang perlu diperbaiki. Silakan periksa kembali formulir.
    </div>
@endif

<div class="panel">
    <form method="GET" action="{{ route('categories.index') }}"
          class="row g-2 mb-4">
        <div class="col-md-8">
            <input type="text" name="search" class="form-control"
                   placeholder="Cari nama kategori..."
                   value="{{ $search }}">
        </div>
        <div class="col-auto">
            <button class="btn btn-outline-primary" type="submit">
                <i class="bi bi-search me-1"></i> Cari
            </button>
        </div>
        <div class="col-auto">
            <a href="{{ route('categories.index') }}"
               class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="panel-title mb-0">Daftar Kategori</h2>
        <span class="text-secondary small">
            {{ $categories->total() }} data
        </span>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Material</th>
                    <th>Status</th>
                    <th style="min-width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $categories->firstItem() + $loop->index }}</td>
                        <td class="fw-semibold">{{ $category->name }}</td>
                        <td>{{ $category->description ?: '-' }}</td>
                        <td>{{ $category->materials_count }}</td>
                        <td>
                            @if ($category->is_active)
                                <span class="badge text-bg-success">Aktif</span>
                            @else
                                <span class="badge text-bg-secondary">Tidak Aktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('categories.edit', $category) }}"
                                   class="btn btn-sm btn-outline-primary"
                                   title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="{{ route('categories.destroy', $category) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-secondary py-5">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                            Belum ada kategori material.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $categories->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
