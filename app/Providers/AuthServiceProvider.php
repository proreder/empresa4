<?php

namespace App\Providers;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //Registyramos el rol para administrador quer puede realizar la administración de usuarios
        Gate::define('usuarios/index', function(User $user){
            return $user->role = User::ROLE_ADMINISTRADOR;
        });

        //registramos el rol para un usuario que puede tener acceso a todo excepto la administración de ususarios
        Gate::define('Usuario-de-aplicación', function(User $user){
            return $user->role = User::ROLE_USUARIO;
        });
    }
}
