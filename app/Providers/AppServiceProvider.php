<?php

namespace App\Providers;

use App\Models\Admin\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.sidebar', function ($view) {

            $menus = collect();

            if (auth()->check()) {

                // Super Admin
                if (auth()->user()->role == 1) {

                    $menus = Menu::whereNull('parent_id')
                        ->where('is_active',1)
                        ->with('childrenRecursive')
                        ->orderBy('sort_order')
                        ->get();

                } else {

                    $menuIds = auth()->user()
                        ->menus()
                        ->pluck('m_menu.id')
                        ->toArray();

                    $menus = Menu::whereNull('parent_id')
                        ->whereIn('id', $menuIds)
                        ->where('is_active',1)
                        ->with([
                            'childrenRecursiveFiltered' => function($q) use ($menuIds){
                                $q->whereIn('id',$menuIds);
                            }
                        ])
                        ->orderBy('sort_order')
                        ->get();

                }
            }

            $view->with('menus', $menus);

        });
    }
}