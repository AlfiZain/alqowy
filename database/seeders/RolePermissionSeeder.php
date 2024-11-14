<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ownerRole = Role::create(['name' => 'owner']);
        $teacherRole = Role::create(['name' => 'teacher']);
        $studentRole = Role::create(['name' => 'student']);

        $userOwner = User::create([
            'name' => 'Owner',
            'occupation' => 'Owner',
            'avatar' => 'images/avatar-default.png',
            'email' => 'owner@email.com',
            'password' => bcrypt('123123123'),
        ]);

        $userOwner->assignRole($ownerRole);
    }
}
