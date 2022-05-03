<?php

namespace Eutranet\Corporate\Database\Seeders;

use Illuminate\Database\Seeder;
use Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('media_collections')) {
            $this->call(MediaCollectionSeeder::class);
        }
        $this->call(CorporateSeeder::class);
        $this->call(AgencySeeder::class);
        $this->call(UpdateAgencyCorporateId::class);
        $this->call(StaffSeeder::class);
        $this->call(CorporateGeneralTermSeeder::class);
        $this->call(CorporateAgreementSeeder::class);
        $this->call(CorporateStaffSeeder::class);
        $this->call(StaffUserSeeder::class);
        $this->call(NotificationTemplateSeeder::class);
    }
}
