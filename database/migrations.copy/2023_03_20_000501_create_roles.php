<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//lineas añadidas para asignacion de rol
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       //creamos tres roles
       $role1=Role::create(['name' => 'admin']);
       $role2=Role::create(['name' => 'usuario']);
       $role3=Role::create(['name' => 'super']);
       //buscamos el usuario
       $user =  User::find(1);
       $user->assignRole($role1);
       $user1 =  User::find(2);
       $user1->assignRole($role2);

       $user2 =  User::find(3);
       $user2->assignRole($role3);
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
