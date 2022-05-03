<?php

namespace Eutranet\Corporate\Database\Seeders;

use Illuminate\Database\Seeder;
use Eutranet\Corporate\Models\CorporateStaffMember;
use Eutranet\Setup\Models\StaffMember;
use Eutranet\Corporate\Models\Corporate;
use Illuminate\Support\Facades\DB;

class CorporateStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('staff_members')->get()->count() >= 1 && DB::table('corporates')->get()->count() === 1 && DB::table('corporate_staff_member')->get()->count() < 1) {
            foreach (DB::table('staff_members')->get() as $staffMember) {
                DB::table('corporate_staff_member')->insert(
                    array('corporate_id' => 1, 'staff_member_id' => $staffMember->id),
                );
            }
        }
    }
}
