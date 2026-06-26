<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\Menu;


class UserController extends Controller
{
    public function index()
    {
        // $users = User::getAll();
	$users = User::where('role', '!=', '0')->get();
        return view('admin.user.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        $menus = Menu::whereNull('parent_id')
            ->where('is_active',1)
            ->with('childrenRecursive')
            ->orderBy('sort_order')
            ->get();
        return view('admin.user.form_create_user', compact('menus'));
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);

        $menus = Menu::whereNull('parent_id')
            ->where('is_active',1)
            ->with('childrenRecursive')
            ->orderBy('sort_order')
            ->get();

        $selectedMenus = $data->menus()
            ->pluck('menu_id')
            ->toArray();

        return view(
            'admin.user.form_edit_user',
            compact('data','menus','selectedMenus')
        );
    }

    public function store(Request $request)
    {
        $users = new User();
        $users->name = $request->nama;
        $users->nip = $request->nip;
        $users->jabatan = $request->jabatan;
        $users->username = $request->username;
        $users->email = $request->email;
        $users->role = $request->role;
        $users->password = bcrypt($request->password1);
        $users->save();

        $menuIds = $this->getMenuIdsWithParents($request->menus ?? []);
        $users->menus()->sync($menuIds);

        return redirect()->route('user')
            ->with('success', 'User berhasil ditambahkan');
    }

    public function update(Request $request)
    {
        $users = User::findOrFail($request->id);

        $users->name = $request->nama;
        $users->nip = $request->nip;
        $users->jabatan = $request->jabatan;
        $users->username = $request->username;
        $users->email = $request->email;
        $users->role = $request->role;

        // Update password only if provided
        if (!empty($request->password1)) {
            $users->password = bcrypt($request->password1);
        }

        $users->save();

        // Update menu access
        $menuIds = $this->getMenuIdsWithParents($request->menus ?? []);
        $users->menus()->sync($menuIds);

        return redirect()
            ->route('user')
            ->with('success', 'User berhasil diupdate');
    }

    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();

        return redirect()->route('user')
            ->with('success', 'User berhasil dihapus');
    }

    private function getMenuIdsWithParents(array $menuIds): array
    {
        $menus = Menu::select('id', 'parent_id')
            ->get()
            ->keyBy('id');

        $result = $menuIds;

        foreach ($menuIds as $id) {

            $menu = $menus->get($id);

            while ($menu && $menu->parent_id) {

                $result[] = $menu->parent_id;

                $menu = $menus->get($menu->parent_id);
            }
        }

        return array_values(array_unique($result));
    }
}
