<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UnitController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $units = Unit::query()
            ->withCount('materials')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('symbol', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('units.index', compact('units', 'search'));
    }

    public function create()
    {
        return view('units.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                'unique:units,name',
            ],
            'symbol' => [
                'required',
                'string',
                'max:20',
                'unique:units,symbol',
            ],
        ]);

        Unit::create($validated);

        return redirect()
            ->route('units.index')
            ->with('success', 'Satuan material berhasil ditambahkan.');
    }

    public function edit(Unit $unit)
    {
        return view('units.edit', compact('unit'));
    }

    public function update(Request $request, Unit $unit)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('units', 'name')->ignore($unit->id),
            ],
            'symbol' => [
                'required',
                'string',
                'max:20',
                Rule::unique('units', 'symbol')->ignore($unit->id),
            ],
        ]);

        $unit->update($validated);

        return redirect()
            ->route('units.index')
            ->with('success', 'Satuan material berhasil diperbarui.');
    }

    public function destroy(Unit $unit)
    {
        if ($unit->materials()->exists()) {
            return redirect()
                ->route('units.index')
                ->with(
                    'error',
                    'Satuan tidak dapat dihapus karena masih digunakan oleh material.'
                );
        }

        $unit->delete();

        return redirect()
            ->route('units.index')
            ->with('success', 'Satuan material berhasil dihapus.');
    }
}