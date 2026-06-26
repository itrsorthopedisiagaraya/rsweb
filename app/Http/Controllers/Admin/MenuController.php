<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display list
     */
    public function index()
    {
        $menus = Menu::whereNull('parent_id')
            ->with('childrenRecursive')
            ->orderBy('sort_order')
            ->get();

        return view('admin.menu.index', compact('menus'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $parents = Menu::whereNull('parent_id')
            ->orderBy('title')
            ->get();

        return view('admin.menu.create', compact('parents'));
    }

    /**
     * Store menu
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'icon' => 'nullable',
            'route' => 'nullable',
            'url' => 'nullable',
            'parent_id' => 'nullable|exists:m_menu,id',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        Menu::create([
            'title' => $request->title,
            'slug' => \Str::slug($request->title),
            'icon' => $request->icon,
            'route' => $request->route,
            'url' => $request->url,
            'parent_id' => $request->parent_id,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('menu.index')
            ->with('success', 'Menu created successfully');
    }

    /**
     * Edit form
     */
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);

        $parents = Menu::whereNull('parent_id')
            ->where('id', '!=', $id)
            ->orderBy('title')
            ->get();

        return view('admin.menu.edit', compact('menu', 'parents'));
    }

    /**
     * Update menu
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'icon' => 'nullable',
            'route' => 'nullable',
            'url' => 'nullable',
            'parent_id' => 'nullable|exists:m_menu,id',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $menu->update([
            'title' => $request->title,
            'slug' => \Str::slug($request->title),
            'icon' => $request->icon,
            'route' => $request->route,
            'url' => $request->url,
            'parent_id' => $request->parent_id,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('menu.index')
            ->with('success', 'Menu updated successfully');
    }

    /**
     * Delete menu
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        // optional safety: prevent deleting parent with children
        if ($menu->children()->count()) {
            return back()->with('error', 'Cannot delete menu with children');
        }

        $menu->delete();

        return back()->with('success', 'Menu deleted successfully');
    }
}