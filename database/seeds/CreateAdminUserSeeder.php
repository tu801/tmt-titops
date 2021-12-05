<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //add admin user
        $chkUser = User::where('email', 'tmtuan801@gmail.com')->first();
        if ( !isset($chkUser->id) ) {
            $user = User::create([
                'name' => 'tmtuan', 
                'email' => 'tmtuan801@gmail.com',
                'password' => bcrypt('123qwe123')
            ]);
      
            $chkRole = Role::where('name', 'Admin')->first();
            if ( !isset($chkRole->id) ) $role = Role::create(['name' => 'Admin']);
            else $role = Role::where('name', 'Admin')->first();
       
            $permissions = Permission::pluck('id','id')->all();
      
            $role->syncPermissions($permissions);
       
            $user->assignRole([$role->id]);
        }


        //add customer user
        $chkUser = User::where('email', 'customer@test.com')->first();
        if ( !isset($chkUser->id) ) {
            $user = User::create([
                'name' => 'customer', 
                'email' => 'customer@test.com',
                'password' => bcrypt('123qwe123')
            ]);
      
            $chkRole = Role::where('name', 'Guest')->first();
            if ( !isset($chkRole->id) ) $role = Role::create(['name' => 'Guest']);
            else $role = Role::where('name', 'Guest')->first();
       
            $user->assignRole([$role->id]);
        }
    }
}
