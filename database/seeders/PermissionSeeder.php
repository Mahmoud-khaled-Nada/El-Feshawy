<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view employees',
            'create employees',
            'update employees',
            'delete employees',

            'view customers',
            'create customers',
            'update customers',
            'delete customers',

            'view pages',
            'create pages',
            'update pages',
            'delete pages',

            'view news',
            'create news',
            'update news',
            'delete news',

            'view aboutus',
            'create aboutus',
            'update aboutus',
            'delete aboutus',

            'view people',
            'create people',
            'update people',
            'delete people',

            'view services',
            'create services',
            'update services',
            'delete services',

            'view contact',
            'create contact',
            'update contact',
            'delete contact',

            'view notifications',
            'create notifications',
            'update notifications',
            'delete notifications',

            'view messages',
            'create messages',
            'update messages',
            'delete messages',

            'view events',
            'create events',
            'update events',
            'delete events',

            'view tasks',
            'create tasks',
            'update tasks',
            'delete tasks',

            'view meeting',
            'create meeting',
            'update meeting',
            'delete meeting',

            'view inquiries',
            'create inquiries',
            'update inquiries',
            'delete inquiries',
        ];
        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::create(['name' => $permission]);
        }
    }
}
