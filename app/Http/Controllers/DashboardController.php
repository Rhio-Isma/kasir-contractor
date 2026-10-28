<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Material;
use App\Models\Project;
use App\Models\Unit;
use App\Models\Warehouse;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'categories' => Category::count(),
            'units' => Unit::count(),
            'warehouses' => Warehouse::count(),
            'materials' => Material::count(),
            'projects' => Project::count(),
            'active_projects' => Project::where(
                'status',
                'ongoing'
            )->count(),
        ];

        $recentProjects = Project::latest()
            ->take(5)
            ->get();

        $recentMaterials = Material::with([
            'category',
            'unit',
        ])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'stats',
            'recentProjects',
            'recentMaterials'
        ));
    }
}
