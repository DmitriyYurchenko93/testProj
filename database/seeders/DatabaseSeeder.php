<?php

namespace Database\Seeders;

use App\Models\CompanyCount;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Admin::factory(1)->create([
            'name' => 'Admin',
            'email' => 'admincompany@test.com',
            'password' => bcrypt('password1'),
        ]);
        CompanyCount::factory(2)->create();
    }
}
