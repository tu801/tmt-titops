<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //add permission
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete'
         ];
    
        foreach ($permissions as $permission) {
            $chk = Permission::where('name', $permission)->first();
            if ( !isset($chk->id) ) Permission::create(['name' => $permission]);
        }
    }
}
