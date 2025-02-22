<?php

namespace Database\Seeders;

use App\Domains\User\Enums\RolesEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $roles = RolesEnum::labels('en');

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => data_get($role, 'value'), 'guard_name' => 'api']);
        }
    }
}
