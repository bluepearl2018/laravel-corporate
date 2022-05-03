<?php

namespace Eutranet\Corporate\Database\Seeders;

use Illuminate\Database\Seeder;
use Eutranet\Corporate\Database\Factories\StaffMemberUserFactory;
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
        new StaffMemberUserFactory();
    }
}
