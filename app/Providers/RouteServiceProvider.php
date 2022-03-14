<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        Route::bind('post', function (string|int $slug) {
            if (is_int($slug)) {
                return Post::find($slug);
            }

            return Post::where('slug', $slug)->first();
        });

        Route::bind('user', function (string|int $username) {
            if (is_int($username)) {
                return User::find($username);
            }

            return User::where('username', $username)->first();
        });

        Route::bind('tag', function (string|int $slug) {
            if (is_int($slug)) {
                return Tag::find($slug);
            }

            return Tag::where('slug', $slug)->first();
        });

        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
