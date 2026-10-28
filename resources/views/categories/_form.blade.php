<div class="mb-3">
    <label for="name" class="form-label">
        Nama Kategori <span class="text-danger">*</span>
    </label>

    <input type="text"
           id="name"
           name="name"
           class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', isset($category) ? $category->name : '') }}"
           placeholder="Contoh: Semen"
           maxlength="100"
           required>

    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Deskripsi</label>

    <textarea id="description"
              name="description"
              rows="4"
              class="form-control @error('description') is-invalid @enderror"
              placeholder="Jelaskan kategori material jika diperlukan">{{ old('description', isset($category) ? $category->description : '') }}</textarea>

    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4">
    <label for="is_active" class="form-label">Status Kategori</label>

    <select id="is_active"
            name="is_active"
            class="form-select @error('is_active') is-invalid @enderror"
            required>
        <option value="1"
            {{ (string) old('is_active', isset($category) ? (int) $category->is_active : 1) === '1' ? 'selected' : '' }}>
            Aktif
        </option>
        <option value="0"
            {{ (string) old('is_active', isset($category) ? (int) $category->is_active : 1) === '0' ? 'selected' : '' }}>
            Tidak Aktif
        </option>
    </select>

    @error('is_active')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">
        <i class="bi bi-save me-1"></i> {{ $submitLabel }}
    </button>

    <a href="{{ route('categories.index') }}"
       class="btn btn-outline-secondary">Batal</a>
</div>
