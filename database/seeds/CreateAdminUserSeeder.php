<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
        	'name' => 'Alice', 
        	'email' => 'alice@gmail.com',
        	'password' => Hash::make('password'),
            'address' => 'Yangon',
            'phone' => '091234567',
        ]);
  
        $role = Role::create(['name' => 'Admin']);
   
        $permissions = Permission::pluck('id','id')->all();
  
        $role->syncPermissions($permissions);
   
        $user->assignRole([$role->id]);

        $user = User::create([
        	'name' => 'Bob', 
        	'email' => 'bob@gmail.com',
        	'password' => Hash::make('password'),
            'address' => 'Yangon',
            'phone' => '09123123123',
        ]);
  
        $role = Role::create(['name' => 'User']);
   
        $permissions = Permission::pluck('id','id')->all();
  
        $role->syncPermissions($permissions);
   
        $user->assignRole([$role->id]);
    }
}
