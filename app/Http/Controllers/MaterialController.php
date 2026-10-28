<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Material;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $categoryId = $request->query('category_id');
        $status = $request->query('status');

        $materials = Material::with(['category', 'unit'])
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('code', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%");
                });
            })
            ->when($categoryId, function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->when($status !== null && $status !== '', function ($query) use ($status) {
                $query->where('is_active', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('materials.index', compact(
            'materials',
            'categories',
            'search',
            'categoryId',
            'status'
        ));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        $units = Unit::orderBy('name')->get();

        return view('materials.create', compact(
            'categories',
            'units'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => [
                'required',
                'string',
                'max:40',
                'unique:materials,code',
            ],
            'name' => ['required', 'string', 'max:200'],
            'category_id' => [
                'required',
                'integer',
                Rule::exists('categories', 'id'),
            ],
            'unit_id' => [
                'required',
                'integer',
                'exists:units,id',
            ],
            'description' => ['nullable', 'string'],
            'minimum_stock' => [
                'required',
                'numeric',
                'min:0',
            ],
            'is_active' => ['required', 'boolean'],
        ]);

        Material::create($validated);

        return redirect()
            ->route('materials.index')
            ->with('success', 'Data material berhasil ditambahkan.');
    }

    public function edit(Material $material)
    {
        $categories = Category::where('is_active', true)
            ->orWhere('id', $material->category_id)
            ->orderBy('name')
            ->get();

        $units = Unit::orderBy('name')->get();

        return view('materials.edit', compact(
            'material',
            'categories',
            'units'
        ));
    }

    public function update(Request $request, Material $material)
    {
        $validated = $request->validate([
            'code' => [
                'required',
                'string',
                'max:40',
                Rule::unique('materials', 'code')->ignore($material->id),
            ],
            'name' => ['required', 'string', 'max:200'],
            'category_id' => [
                'required',
                'integer',
                Rule::exists('categories', 'id')
                    ->where('is_active', true)
                    ->when(
                        $material->category_id,
                        fn ($rule) => $rule
                    ),
            ],
            'unit_id' => [
                'required',
                'integer',
                'exists:units,id',
            ],
            'description' => ['nullable', 'string'],
            'minimum_stock' => [
                'required',
                'numeric',
                'min:0',
            ],
            'is_active' => ['required', 'boolean'],
        ]);

        $material->update($validated);

        return redirect()
            ->route('materials.index')
            ->with('success', 'Data material berhasil diperbarui.');
    }

    public function destroy(Material $material)
    {
        $material->delete();

        return redirect()
            ->route('materials.index')
            ->with('success', 'Data material berhasil dihapus.');
    }
}