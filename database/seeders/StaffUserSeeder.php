<?php

namespace Eutranet\Corporate\Database\Seeders;

use Illuminate\Database\Seeder;
use Eutranet\Corporate\Database\Factories\StaffPortfolioFactory;
use Database\Factories\UserFactory;

class StaffUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        new StaffPortfolioFactory();
    }
}
