@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h1 class="page-title mb-1">Dashboard</h1>
        <p class="text-secondary small mb-0">
            Ringkasan persediaan material dan proyek konstruksi.
        </p>
    </div>

    <span class="badge text-bg-light border p-2">
        <i class="bi bi-calendar3 me-1"></i>
        {{ now()->translatedFormat('d F Y') }}
    </span>
</div>

<div class="row g-3 mb-4">

    <div class="col-12 col-sm-6 col-xl-4">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <span class="stat-label">Total Material</span>
                <div class="stat-icon">
                    <i class="bi bi-box-seam"></i>
                </div>
            </div>
            <div class="stat-number">{{ $stats['materials'] }}</div>
            <div class="stat-label">Jenis material terdaftar</div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-4">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <span class="stat-label">Kategori Material</span>
                <div class="stat-icon">
                    <i class="bi bi-tags"></i>
                </div>
            </div>
            <div class="stat-number">{{ $stats['categories'] }}</div>
            <div class="stat-label">Kategori yang tersedia</div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-4">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <span class="stat-label">Satuan Material</span>
                <div class="stat-icon">
                    <i class="bi bi-rulers"></i>
                </div>
            </div>
            <div class="stat-number">{{ $stats['units'] }}</div>
            <div class="stat-label">Satuan yang digunakan</div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-4">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <span class="stat-label">Total Gudang</span>
                <div class="stat-icon">
                    <i class="bi bi-building"></i>
                </div>
            </div>
            <div class="stat-number">{{ $stats['warehouses'] }}</div>
            <div class="stat-label">Gudang terdaftar</div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-4">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <span class="stat-label">Total Proyek</span>
                <div class="stat-icon">
                    <i class="bi bi-cone-striped"></i>
                </div>
            </div>
            <div class="stat-number">{{ $stats['projects'] }}</div>
            <div class="stat-label">Seluruh proyek terdaftar</div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-4">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <span class="stat-label">Proyek Berjalan</span>
                <div class="stat-icon">
                    <i class="bi bi-clipboard-check"></i>
                </div>
            </div>
            <div class="stat-number">{{ $stats['active_projects'] }}</div>
            <div class="stat-label">Proyek berstatus ongoing</div>
        </div>
    </div>

</div>

<div class="row g-3">

    <div class="col-12 col-xl-7">
        <div class="panel">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="panel-title mb-0">Proyek Terbaru</h2>
                <i class="bi bi-cone-striped text-secondary fs-5"></i>
            </div>

            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Proyek</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentProjects as $project)
                            <tr>
                                <td class="fw-semibold">
                                    {{ $project->code }}
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $project->name }}</div>
                                    <small class="text-secondary">
                                        {{ $project->client_name ?: 'Klien belum diisi' }}
                                    </small>
                                </td>
                                <td>
                                    @php
                                        $statusLabels = [
                                            'planning' => 'Perencanaan',
                                            'ongoing' => 'Berjalan',
                                            'completed' => 'Selesai',
                                            'cancelled' => 'Dibatalkan',
                                        ];

                                        $statusColors = [
                                            'planning' => 'secondary',
                                            'ongoing' => 'primary',
                                            'completed' => 'success',
                                            'cancelled' => 'danger',
                                        ];
                                    @endphp

                                    <span class="badge text-bg-{{ $statusColors[$project->status] ?? 'secondary' }}">
                                        {{ $statusLabels[$project->status] ?? ucfirst($project->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-secondary py-4">
                                    Belum ada data proyek.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-5">
        <div class="panel">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="panel-title mb-0">Material Terbaru</h2>
                <i class="bi bi-box-seam text-secondary fs-5"></i>
            </div>

            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Kode / Nama</th>
                            <th>Kategori</th>
                            <th>Satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentMaterials as $material)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $material->name }}</div>
                                    <small class="text-secondary">
                                        {{ $material->code }}
                                    </small>
                                </td>
                                <td>{{ $material->category->name }}</td>
                                <td>{{ $material->unit->symbol }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-secondary py-4">
                                    Belum ada data material.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection
