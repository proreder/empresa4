<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
//incluimos la libreria para incluir permisos
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Creamos los dos roles 
        $role1=Role::create(['name' => 'Admin']);
        $role2=Role::create(['name' => 'Usuario']);

        //Creamos los permisos de acceso a las rutas
        //permisos para usuarios
        Permission::create(['name' => 'usuario.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'usuario.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'usuario.delete'])->syncRoles([$role1]);
        Permission::create(['name' => 'usuarios'])->syncRoles([$role1]);;
        //permisos para conductores
        Permission::create(['name' => 'conductores.index'])->syncRoles([$role1,$role2]);;
        Permission::create(['name' => 'listarConductores'])->syncRoles([$role1,$role2]);;
        Permission::create(['name' => 'borrarConductor'])->syncRoles([$role1,$role2]);;
        Permission::create(['name' => 'obtenerCandidatos'])->syncRoles([$role1,$role2]);;
        Permission::create(['name' => 'agregarConductor'])->syncRoles([$role1,$role2]);;

        //permisos para vehículos
        Permission::create(['name' => 'listarVehiculos'])->syncRoles([$role1,$role2]);;
        Permission::create(['name' => 'crearVehiculo'])->syncRoles([$role1,$role2]);;
        Permission::create(['name' => 'borrarVehiculo'])->syncRoles([$role1,$role2]);;
        Permission::create(['name' => 'updateVehiculo'])->syncRoles([$role1,$role2]);;

        //permisos para empleados

        Permission::create(['name' => 'empleados.index'])->syncRoles([$role1,$role2]);;
        Permission::create(['name' => 'empleados.store'])->syncRoles([$role1,$role2]);;
        Permission::create(['name' => 'empleados.create'])->syncRoles([$role1,$role2]);;
        Permission::create(['name' => 'empleados.update'])->syncRoles([$role1,$role2]);;
        Permission::create(['name' => 'empleados.destroy'])->syncRoles([$role1,$role2]);;
        Permission::create(['name' => 'empleados.edit'])->syncRoles([$role1,$role2]);;
        
    }
}
