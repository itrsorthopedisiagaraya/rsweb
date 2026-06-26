<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Menu;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        Menu::truncate();

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */
        Menu::create([
            'title'       => 'Dashboard',
            'slug'        => 'dashboard',
            'icon'        => 'ti ti-layout-dashboard',
            'route'       => 'dashboard',
            'url'         => null,
            'parent_id'   => null,
            'sort_order'  => 1,
            'permission'  => null,
            'is_active'   => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Master
        |--------------------------------------------------------------------------
        */
        $master = Menu::create([
            'title'       => 'Master',
            'slug'        => 'master',
            'icon'        => 'fa fa-folder',
            'route'       => null,
            'url'         => null,
            'parent_id'   => null,
            'sort_order'  => 2,
            'permission'  => null,
            'is_active'   => true,
        ]);

        Menu::create([
            'title'       => 'Dokter',
            'slug'        => 'dokter',
            'icon'        => 'fa fa-user-md',
            'route'       => 'dokter',
            'url'         => null,
            'parent_id'   => $master->id,
            'sort_order'  => 1,
            'permission'  => null,
            'is_active'   => true,
        ]);

        Menu::create([
            'title'       => 'Jadwal Dokter',
            'slug'        => 'jadwal-dokter',
            'icon'        => 'fa fa-calendar',
            'route'       => 'dokter.jadwal',
            'url'         => null,
            'parent_id'   => $master->id,
            'sort_order'  => 2,
            'permission'  => null,
            'is_active'   => true,
        ]);

        Menu::create([
            'title'       => 'Kategori',
            'slug'        => 'kategori',
            'icon'        => 'fa fa-list-ol',
            'route'       => 'kategori',
            'url'         => null,
            'parent_id'   => $master->id,
            'sort_order'  => 3,
            'permission'  => null,
            'is_active'   => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Display
        |--------------------------------------------------------------------------
        */
        $display = Menu::create([
            'title'       => 'Display',
            'slug'        => 'display',
            'icon'        => 'fa fa-desktop',
            'route'       => null,
            'url'         => null,
            'parent_id'   => null,
            'sort_order'  => 3,
            'permission'  => null,
            'is_active'   => true,
        ]);

        Menu::create([
            'title'       => 'Partner & Asuransi',
            'slug'        => 'partner-asuransi',
            'icon'        => 'fa fa-handshake',
            'route'       => 'partnerAsuransi',
            'url'         => null,
            'parent_id'   => $display->id,
            'sort_order'  => 1,
            'permission'  => null,
            'is_active'   => true,
        ]);

        Menu::create([
            'title'       => 'Layanan Medis',
            'slug'        => 'layanan-medis',
            'icon'        => 'fa fa-hospital',
            'route'       => 'listLayananMedis',
            'url'         => null,
            'parent_id'   => $display->id,
            'sort_order'  => 2,
            'permission'  => null,
            'is_active'   => true,
        ]);

        Menu::create([
            'title'       => 'Tentang Kami',
            'slug'        => 'tentang-kami',
            'icon'        => 'fa fa-info-circle',
            'route'       => 'aboutus',
            'url'         => null,
            'parent_id'   => $display->id,
            'sort_order'  => 3,
            'permission'  => null,
            'is_active'   => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Postingan
        |--------------------------------------------------------------------------
        */
        $postingan = Menu::create([
            'title'       => 'Postingan',
            'slug'        => 'postingan',
            'icon'        => 'fa fa-newspaper',
            'route'       => null,
            'url'         => null,
            'parent_id'   => $display->id,
            'sort_order'  => 4,
            'permission'  => null,
            'is_active'   => true,
        ]);

        Menu::create([
            'title'       => 'Berita',
            'slug'        => 'berita',
            'icon'        => 'fa fa-hashtag',
            'route'       => 'postingan',
            'url'         => null,
            'parent_id'   => $postingan->id,
            'sort_order'  => 1,
            'permission'  => null,
            'is_active'   => true,
        ]);

        Menu::create([
            'title'       => 'Karir',
            'slug'        => 'karir',
            'icon'        => 'fa fa-briefcase',
            'route'       => 'karir.admin',
            'url'         => null,
            'parent_id'   => $postingan->id,
            'sort_order'  => 2,
            'permission'  => null,
            'is_active'   => true,
        ]);

        Menu::create([
            'title'       => 'Promo',
            'slug'        => 'promo',
            'icon'        => 'fa fa-tags',
            'route'       => 'listPromo',
            'url'         => null,
            'parent_id'   => $postingan->id,
            'sort_order'  => 3,
            'permission'  => null,
            'is_active'   => true,
        ]);

        Menu::create([
            'title'       => 'Layanan Unggulan',
            'slug'        => 'layanan-unggulan',
            'icon'        => 'fa fa-star',
            'route'       => 'layanan',
            'url'         => null,
            'parent_id'   => $postingan->id,
            'sort_order'  => 4,
            'permission'  => null,
            'is_active'   => true,
        ]);

        Menu::create([
            'title'       => 'Pesan',
            'slug'        => 'pesan',
            'icon'        => 'fa fa-envelope',
            'route'       => 'pesan.index',
            'url'         => null,
            'parent_id'   => $display->id,
            'sort_order'  => 5,
            'permission'  => null,
            'is_active'   => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | User Permission
        |--------------------------------------------------------------------------
        */
        $permission = Menu::create([
            'title'       => 'User Permission',
            'slug'        => 'user-permission',
            'icon'        => 'fa fa-users',
            'route'       => null,
            'url'         => null,
            'parent_id'   => null,
            'sort_order'  => 4,
            'permission'  => null,
            'is_active'   => true,
        ]);

        Menu::create([
            'title'       => 'User',
            'slug'        => 'user',
            'icon'        => 'fa fa-user',
            'route'       => 'user',
            'url'         => null,
            'parent_id'   => $permission->id,
            'sort_order'  => 1,
            'permission'  => null,
            'is_active'   => true,
        ]);

        Menu::create([
            'title'       => 'User Akses',
            'slug'        => 'user-akses',
            'icon'        => 'fa fa-user-plus',
            'route'       => 'user.access',
            'url'         => null,
            'parent_id'   => $permission->id,
            'sort_order'  => 2,
            'permission'  => null,
            'is_active'   => true,
        ]);
    }
}