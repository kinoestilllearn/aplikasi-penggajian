<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class RolesPermissionsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'permission-create',
            'permission-delete',
            'permission-edit',
            'permission-index',
            'role-create',
            'role-delete',
            'role-edit',
            'role-index',
            'user-create',
            'user-delete',
            'user-edit',
            'user-index',

            'penggajian-create',
            'penggajian-delete',
            'penggajian-edit',
            'penggajian-index',

            'pegawai-create',
            'pegawai-delete',
            'pegawai-edit',
            'pegawai-index',

            'presensi-create',
            'presensi-delete',
            'presensi-edit',
            'presensi-index',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles
        $roles = [
            'staff-payroll',
            'supervisor-payroll',
            'user',
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        // sync permissions to role

        $role = Role::where('name', 'staff-payroll')->first();
        $role->syncPermissions($permissions);

        $roleSpv = Role::where('name', 'supervisor-payroll')->first();
        $roleSpv->syncPermissions('penggajian-index', 'penggajian-edit');

    }
}
