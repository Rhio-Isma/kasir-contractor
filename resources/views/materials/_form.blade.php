<div class="row">
    <div class="col-md-4 mb-3">
        <label for="code" class="form-label">Kode Material</label>
        <input type="text" name="code" id="code"
            class="form-control @error('code') is-invalid @enderror"
            value="{{ old('code', $material->code ?? '') }}"
            placeholder="Contoh: MAT-001" maxlength="40" required>
        @error('code')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-8 mb-3">
        <label for="name" class="form-label">Nama Material</label>
        <input type="text" name="name" id="name"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $material->name ?? '') }}"
            placeholder="Contoh: Semen Portland" maxlength="200" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="category_id" class="form-label">
            Kategori Material
        </label>
        <select name="category_id" id="category_id"
            class="form-select @error('category_id') is-invalid @enderror"
            required>
            <option value="">-- Pilih Kategori --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    @selected((string) old('category_id', $material->category_id ?? '') === (string) $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="unit_id" class="form-label">Satuan Material</label>
        <select name="unit_id" id="unit_id"
            class="form-select @error('unit_id') is-invalid @enderror"
            required>
            <option value="">-- Pilih Satuan --</option>
            @foreach($units as $unit)
                <option value="{{ $unit->id }}"
                    @selected((string) old('unit_id', $material->unit_id ?? '') === (string) $unit->id)>
                    {{ $unit->name }} ({{ $unit->symbol }})
                </option>
            @endforeach
        </select>
        @error('unit_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mb-3">
    <label for="minimum_stock" class="form-label">
        Batas Stok Minimum
    </label>
    <input type="number" name="minimum_stock" id="minimum_stock"
        class="form-control @error('minimum_stock') is-invalid @enderror"
        value="{{ old('minimum_stock', $material->minimum_stock ?? '0') }}"
        min="0" step="0.01" required>
    @error('minimum_stock')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <div class="form-text">
        Batas ini akan digunakan untuk menandai material yang stoknya rendah.
    </div>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Deskripsi</label>
    <textarea name="description" id="description" rows="3"
        class="form-control @error('description') is-invalid @enderror"
        placeholder="Spesifikasi atau keterangan material">{{ old('description', $material->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4">
    <label for="is_active" class="form-label">Status Material</label>
    <select name="is_active" id="is_active"
        class="form-select @error('is_active') is-invalid @enderror"
        required>
        <option value="1"
            @selected((string) old('is_active', isset($material) ? (int) $material->is_active : 1) === '1')>
            Aktif
        </option>
        <option value="0"
            @selected((string) old('is_active', isset($material) ? (int) $material->is_active : 1) === '0')>
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
    <a href="{{ route('materials.index') }}"
        class="btn btn-secondary">Batal</a>
</div>