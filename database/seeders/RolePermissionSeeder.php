<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name'=>'add-admin']);      
        Permission::create(['name'=>'hide-post']);  
        Permission::create(['name'=>'lihat-profil']);  

        Permission::create(['name'=>'add-post']);
        Permission::create(['name'=>'delete-post']);
        Permission::create(['name'=>'edit-post']);

        Role::create(['name'=>'admin']);
        Role::create(['name'=>'pengguna']);

        $roleAdmin = Role::findByName('admin');
        $roleAdmin->givePermissionTo('add-admin');
        $roleAdmin->givePermissionTo('hide-post');
        $roleAdmin->givePermissionTo('lihat-profil');
        
        $roleAdmin = Role::findByName('pengguna');
        $roleAdmin->givePermissionTo('add-post');
        $roleAdmin->givePermissionTo('delete-post');
        $roleAdmin->givePermissionTo('edit-post');

    }
}
