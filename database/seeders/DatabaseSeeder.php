<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $tenant = Tenant::firstOrCreate(
                ['slug' => 'demo'],
                ['name' => 'Demo Company', 'is_active' => true]
            );

            User::withoutGlobalScopes()->updateOrCreate(
                ['tenant_id' => $tenant->id, 'username' => 'admin'],
                [
                    'name'      => 'Demo Admin',
                    'email'     => 'admin@demo.test',
                    'password'  => 'password', // hashed by the User model cast
                    'is_active' => true,
                ]
            );
        });
    }
}
