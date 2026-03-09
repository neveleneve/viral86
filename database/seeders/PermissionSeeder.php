<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder {
    public function run(): void {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view-dashboard',

            'view-konten',
            'create-konten',
            'edit-konten',
            'delete-konten',
            'publish-konten',

            'view-media',
            'upload-media',
            'delete-media',

            'view-kategori',
            'create-kategori',
            'edit-kategori',
            'delete-kategori',

            'view-tag',
            'create-tag',
            'edit-tag',
            'delete-tag',

            'view-iklan',
            'create-iklan',
            'edit-iklan',
            'delete-iklan',
            'approve-iklan',

            'view-user-redaksi',
            'manage-user-redaksi',

            'view-user-pembaca',
            'manage-user-pembaca',

            'view-user-pengiklan',
            'manage-user-pengiklan',

            'view-pengaturan',
            'edit-pengaturan',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $reporter = Role::findByName('reporter');
        if ($reporter) {
            $reporter->syncPermissions([
                'view-dashboard',
                'view-konten',
                'create-konten',
                'view-media',
                'upload-media',
                'view-kategori',
                'view-tag'
            ]);
        }

        $redaktur = Role::findByName('redaktur');
        if ($redaktur) {
            $redaktur->syncPermissions([
                'view-dashboard',
                'view-konten',
                'create-konten',
                'edit-konten',
                'view-media',
                'upload-media',
                'delete-media',
                'view-kategori',
                'create-kategori',
                'edit-kategori',
                'view-tag',
                'create-tag',
                'edit-tag',
            ]);
        }

        $pemred = Role::findByName('pemimpin-redaksi');
        if ($pemred) {
            $pemred->syncPermissions([
                'view-dashboard',
                'view-konten',
                'create-konten',
                'edit-konten',
                'delete-konten',
                'publish-konten',
                'view-media',
                'upload-media',
                'delete-media',
                'view-kategori',
                'create-kategori',
                'edit-kategori',
                'delete-kategori',
                'view-tag',
                'create-tag',
                'edit-tag',
                'delete-tag',
                'view-user-redaksi'
            ]);
        }

        $marketing = Role::findByName('marketing-ads');
        if ($marketing) {
            $marketing->syncPermissions([
                'view-dashboard',
                'view-iklan',
                'create-iklan',
                'edit-iklan',
                'delete-iklan',
                'approve-iklan',
                'view-user-pengiklan',
                'manage-user-pengiklan'
            ]);
        }

        $superAdmin = Role::findByName('super-admin');
        if ($superAdmin) {
            $superAdmin->syncPermissions(Permission::all());
        }
    }
}
