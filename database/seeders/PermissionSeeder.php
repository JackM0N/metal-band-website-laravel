<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        Permission::create(['name' => 'users.index']);
        Permission::create(['name' => 'users.store']);
        Permission::create(['name' => 'users.destroy']);
        Permission::create(['name' => 'users.change_role']);

        Permission::create(['name' => 'songs.index']);
        Permission::create(['name' => 'songs.manage']);
        
        Permission::create(['name' => 'albums.index']);
        Permission::create(['name' => 'albums.manage']);
        
        Permission::create(['name' => 'tours.index']);
        Permission::create(['name' => 'tours.manage']);

        Permission::create(['name' => 'concerts.index']);
        Permission::create(['name' => 'concerts.manage']);

        Permission::create(['name' => 'news.index']);
        Permission::create(['name' => 'news.manage']);


        //Admin systemu
        $userRole = Role::findByName(config('auth.roles.admin'));
        $userRole->givePermissionTo('users.index');
        $userRole->givePermissionTo('users.store');
        $userRole->givePermissionTo('users.destroy');
        $userRole->givePermissionTo('users.change_role');
        $userRole->givePermissionTo('songs.index');
        $userRole->givePermissionTo('songs.manage');
        $userRole->givePermissionTo('albums.index');
        $userRole->givePermissionTo('albums.manage');
        $userRole->givePermissionTo('tours.index');
        $userRole->givePermissionTo('tours.manage');
        $userRole->givePermissionTo('concerts.index');
        $userRole->givePermissionTo('concerts.manage');
        $userRole->givePermissionTo('news.index');
        $userRole->givePermissionTo('news.manage');

        //Użytkownik systemu
        $userRole = Role::findByName(config('auth.roles.user'));
        $userRole->givePermissionTo('songs.index');
        $userRole->givePermissionTo('albums.index');
        $userRole->givePermissionTo('tours.index');
        $userRole->givePermissionTo('concerts.index');
        $userRole->givePermissionTo('news.index');
    }
}
