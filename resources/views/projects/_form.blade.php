<div class="row">
    <div class="col-md-4 mb-3">
        <label for="code" class="form-label">Kode Proyek</label>
        <input type="text" name="code" id="code"
            class="form-control @error('code') is-invalid @enderror"
            value="{{ old('code', $project->code ?? '') }}"
            placeholder="Contoh: PRJ-001" maxlength="30" required>
        @error('code')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-8 mb-3">
        <label for="name" class="form-label">Nama Proyek</label>
        <input type="text" name="name" id="name"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $project->name ?? '') }}"
            placeholder="Contoh: Pembangunan Gedung Kantor" maxlength="200"
            required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="client_name" class="form-label">Nama Klien</label>
        <input type="text" name="client_name" id="client_name"
            class="form-control @error('client_name') is-invalid @enderror"
            value="{{ old('client_name', $project->client_name ?? '') }}"
            placeholder="Nama perusahaan atau klien">
        @error('client_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="location" class="form-label">Lokasi Proyek</label>
        <input type="text" name="location" id="location"
            class="form-control @error('location') is-invalid @enderror"
            value="{{ old('location', $project->location ?? '') }}"
            placeholder="Kota atau alamat proyek">
        @error('location')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label for="start_date" class="form-label">Tanggal Mulai</label>
        <input type="date" name="start_date" id="start_date"
            class="form-control @error('start_date') is-invalid @enderror"
            value="{{ old('start_date', isset($project) && $project->start_date ? $project->start_date->format('Y-m-d') : '') }}">
        @error('start_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label for="end_date" class="form-label">Tanggal Selesai</label>
        <input type="date" name="end_date" id="end_date"
            class="form-control @error('end_date') is-invalid @enderror"
            value="{{ old('end_date', isset($project) && $project->end_date ? $project->end_date->format('Y-m-d') : '') }}">
        @error('end_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label for="budget" class="form-label">Anggaran Proyek (Rp)</label>
        <input type="number" name="budget" id="budget"
            class="form-control @error('budget') is-invalid @enderror"
            value="{{ old('budget', $project->budget ?? '0') }}"
            min="0" step="0.01" required>
        @error('budget')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mb-3">
    <label for="status" class="form-label">Status Proyek</label>
    <select name="status" id="status"
        class="form-select @error('status') is-invalid @enderror" required>
        <option value="planning"
            @selected(old('status', $project->status ?? 'planning') === 'planning')>
            Perencanaan
        </option>
        <option value="ongoing"
            @selected(old('status', $project->status ?? '') === 'ongoing')>
            Berjalan
        </option>
        <option value="completed"
            @selected(old('status', $project->status ?? '') === 'completed')>
            Selesai
        </option>
        <option value="cancelled"
            @selected(old('status', $project->status ?? '') === 'cancelled')>
            Dibatalkan
        </option>
    </select>
    @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4">
    <label for="description" class="form-label">Deskripsi Proyek</label>
    <textarea name="description" id="description" rows="4"
        class="form-control @error('description') is-invalid @enderror"
        placeholder="Tuliskan ruang lingkup atau keterangan proyek">{{ old('description', $project->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">
        <i class="bi bi-save"></i> {{ $submitLabel }}
    </button>
    <a href="{{ route('projects.index') }}"
        class="btn btn-secondary">Batal</a>
</div>