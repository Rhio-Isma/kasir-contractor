<div class="mb-3">
    <label for="name" class="form-label">Nama Satuan</label>

    <input type="text"
        name="name"
        id="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $unit->name ?? '') }}"
        placeholder="Contoh: Kilogram"
        maxlength="50"
        required>

    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="symbol" class="form-label">Simbol Satuan</label>

    <input type="text"
        name="symbol"
        id="symbol"
        class="form-control @error('symbol') is-invalid @enderror"
        value="{{ old('symbol', $unit->symbol ?? '') }}"
        placeholder="Contoh: kg"
        maxlength="20"
        required>

    @error('symbol')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    <div class="form-text">
        Contoh simbol: sak, kg, m, m², m³, batang, liter.
    </div>
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">
        <i class="bi bi-save"></i> {{ $submitLabel }}
    </button>

    <a href="{{ route('units.index') }}"
        class="btn btn-secondary">
        Batal
    </a>
</div>