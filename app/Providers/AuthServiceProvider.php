<?php

namespace App\Providers;

use App\Models\Answer;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
//         'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::before(function ($user , $ability){
            return $user->hasRole('Super_Admin') ? true : null;
        });

        Gate::define('update&delete-thread-user' , function (User $user , Thread $thread){
           return $user->id == $thread->user_id;
        });

        Gate::define('update&delete-answer-user' , function (User $user , Answer $answer){
           return $user->id == $answer->user_id;
        });


    }
}
