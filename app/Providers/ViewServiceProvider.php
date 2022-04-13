<?php

namespace App\Providers;

use App\Enums\AlertType;
use App\Enums\UserRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\Flash\Flash;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Flash::levels([
            'success' => AlertType::SUCCESS->name,
            'danger'  => AlertType::DANGER->name,
            'warning' => AlertType::WARNING->name,
            'info'    => AlertType::INFO->name,
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('admin.posts.form', function (\Illuminate\View\View $view) {
            return $view->with('authors', User::withRole(UserRole::AUTHOR)->get());
        });

        View::composer('admin.users.*', function (\Illuminate\View\View $view) {
            return $view->with('roles', Role::all());
        });
    }
}
