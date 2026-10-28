<div class="row">
    <div class="col-md-6 mb-3">
        <label for="code" class="form-label">Kode Gudang</label>

        <input type="text"
            name="code"
            id="code"
            class="form-control @error('code') is-invalid @enderror"
            value="{{ old('code', $warehouse->code ?? '') }}"
            placeholder="Contoh: GDG-001"
            maxlength="30"
            required>

        @error('code')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="name" class="form-label">Nama Gudang</label>

        <input type="text"
            name="name"
            id="name"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $warehouse->name ?? '') }}"
            placeholder="Contoh: Gudang Utama"
            maxlength="150"
            required>

        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mb-3">
    <label for="address" class="form-label">Alamat Gudang</label>

    <textarea name="address"
        id="address"
        class="form-control @error('address') is-invalid @enderror"
        rows="2"
        maxlength="255"
        placeholder="Masukkan alamat gudang">{{ old('address', $warehouse->address ?? '') }}</textarea>

    @error('address')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Keterangan</label>

    <textarea name="description"
        id="description"
        class="form-control @error('description') is-invalid @enderror"
        rows="3"
        placeholder="Keterangan tambahan jika diperlukan">{{ old('description', $warehouse->description ?? '') }}</textarea>

    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4">
    <label for="is_active" class="form-label">Status Gudang</label>

    <select name="is_active"
        id="is_active"
        class="form-select @error('is_active') is-invalid @enderror"
        required>
        <option value="1"
            @selected((string) old('is_active', isset($warehouse) ? (int) $warehouse->is_active : 1) === '1')>
            Aktif
        </option>
        <option value="0"
            @selected((string) old('is_active', isset($warehouse) ? (int) $warehouse->is_active : 1) === '0')>
            Tidak Aktif
        </option>
    </select>

    @error('is_active')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">
        <i class="bi bi-save"></i> {{ $submitLabel }}
    </button>

    <a href="{{ route('warehouses.index') }}"
        class="btn btn-secondary">
        Batal
    </a>
</div>