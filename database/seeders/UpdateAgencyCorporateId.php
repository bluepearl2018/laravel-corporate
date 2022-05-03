<?php

namespace Eutranet\Corporate\Database\Seeders;

use Illuminate\Database\Seeder;
use Eutranet\Corporate\Models\Agency;

class UpdateAgencyCorporateId extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = array('corporate_id' => '1');
        foreach (Agency::get() as $agency) {
            $agency->update($values);
        }
    }
}
