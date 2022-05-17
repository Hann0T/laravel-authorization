<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Post;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Post' => 'App\Policies\PostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('cansee-all-posts', function (User $user) {
        //     return $user->role == 'admin';
        // });

        // Gate::define('create-post', function (User $user, Post $post) {
        //     return $user->role == 'admin';
        // });

        // Gate::define('update-post', function (User $user, Post $post) {
        //     return $user->id == $post->user_id || $user->role == 'admin';
        // });

        // Gate::define('destroy-post', function (User $user, Post $post) {
        //     return $user->id == $post->user_id || $user->role == 'admin';
        // });
    }
}
