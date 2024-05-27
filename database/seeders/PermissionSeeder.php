<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
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

        // create permissions
        $tables = [
            [
                'name' => 'insurance',
                'public_name' => 'maison d\'assurance',
            ],
            [
                'name' => 'user',
                'public_name' => 'utilisateur',
            ],
            [
                'name' => 'role',
                'public_name' => 'role',
            ],
            [
                'name' => 'cashier',
                'public_name' => 'caissier',
            ],
            [
                'name' => 'hospital',
                'public_name' => 'hôpital',
            ],
            [
                'name' => 'accountant',
                'public_name' => 'comptable',
            ],
            [
                'name' => 'doctor',
                'public_name' => 'docteur',
            ],
            [
                'name' => 'pharmacist',
                'public_name' => 'pharmacien',
            ],
            [
                'name' => 'nurse',
                'public_name' => 'infirmier',
            ],
            [
                'name' => 'patient',
                'public_name' => 'patient',
            ],
        ];

        foreach ($tables as $table) {
            Permission::create(
                [
                    'name' => 'create-' . $table['name'],
                    'public_name' => 'créer un(e) ' . $table['public_name'],
                    'guard_name' => 'web',
                ]
            );
            Permission::create(
                [
                    'name' => 'update-' . $table['name'],
                    'public_name' => 'modifier un(e) ' . $table['public_name'],
                    'guard_name' => 'web',
                ]
            );
            Permission::create(
                [
                    'name' => 'read-' . $table['name'],
                    'public_name' => 'lire un(e) ' . $table['public_name'],
                    'guard_name' => 'web',
                ]
            );
            Permission::create(
                [
                    'name' => 'delete-' . $table['name'],
                    'public_name' => 'supprimer un(e) ' . $table['public_name'],
                    'guard_name' => 'web',
                ]
            );
        }

        $permissions = Permission::all();

        $role1 = Role::create([
            'name' => 'root',
            'public_name' => 'super-admin',
        ]);

        $role1->syncPermissions($permissions);

        $role6 = Role::create([
            'name' => 'admin',
            'public_name' => 'admin',
        ]);
        $role6->syncPermissions($permissions);

        $user = User::create([
            'name' => 'merite',
            'email' => 'meritekioungou1@gmail.com',
            'password' => 'Mbongui@1992',
        ]);

        $user->assignRole($role1);
    }
}
