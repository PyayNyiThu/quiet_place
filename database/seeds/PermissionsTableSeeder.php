<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'room-list',
            'room-create',
            'room-edit',
            'room-delete',
            'room-restore',
            'room_type-list',
            'room_type-create',
            'room_type-edit',
            'room_type-delete',
            'room_type-restore',
            'service-list',
            'service-create',
            'service-edit',
            'service-delete',
            'service-restore',
            'township-list',
            'township-create',
            'township-edit',
            'township-delete',
            'township-restore',
            'booking-list',
            'booking-create',
            'booking-edit',
            'booking-delete',
            'booking-restore',
            'customer-list',
            'customer-create',
            'customer-edit',
            'customer-delete',
            'customer-restore',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'user-restore',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'role-restore'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
