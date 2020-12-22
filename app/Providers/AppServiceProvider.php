<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Contracts\Auth\Guard;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events,Guard $auth)
    {
        $role = \App\Roles::where('id', Auth::user()['role_id'])->first()['label'];
        \Log::info("Auth Data :". $auth->user());
        if ($role=='admin') {
            $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
                // Add some items to the menu...
                $event->menu->add('MAIN DATA');
                $event->menu->add([
                    'text' => 'Blog',
                    'url' => 'admin/blog',
                ]);
            });
        }elseif ($role=="produsen") {
            $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
                // Add some items to the menu...
                $event->menu->add('MAIN2 DATA');
                $event->menu->add([
                    'text' => 'Blog',
                    'url' => 'admin/blog',
                ]);
            });
        }
    }
}
