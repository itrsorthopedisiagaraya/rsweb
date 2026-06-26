<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin\Menu;
use Illuminate\Http\Request;

class UserAccessController extends Controller
{
    /**
     * Show user access page.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $menus = Menu::whereNull('parent_id')
            ->where('is_active', 1)
            ->with('childrenRecursive')
            ->orderBy('sort_order')
            ->get();

        $selectedMenus = $user->menus()
            ->pluck('menu_id')
            ->toArray();

        return view(
            'admin.user-access.edit',
            compact('user', 'menus', 'selectedMenus')
        );
    }

    /**
     * Save menu access.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'menus' => 'nullable|array',
            'menus.*' => 'exists:m_menu,id',
        ]);

        $user = User::findOrFail($id);

        $user->menus()->sync(
            $request->menus ?? []
        );

        return redirect()
            ->back()
            ->with('success', 'User access updated successfully.');
    }
}