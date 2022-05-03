<?php

namespace Eutranet\Corporate\Database\Seeders;

use Illuminate\Database\Seeder;
use Eutranet\Corporate\Models\CorporateGeneralTerm;
use DB;

class CorporateGeneralTermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (CorporateGeneralTerm::count() < 1) {
            // Todo ask for general_terms and gdpr, etc.
            DB::table('corporate_general_terms')->insert(
                array(
                    array(
                        // Coporate General terms ID = 1
                        'title' => 'Corporate General terms',
                        'description' => 'Contact center General terms',
                        'lead' => 'Corporate General terms Intro',
                        'body' => 'Corporate General terms text',
                    ),
                    array(
                        // Coporate Privacu policy, ID = 2
                        'description' => 'Corporate privacy policy',
                        'title' => 'Privacy policy',
                        'lead' => 'Privacy policy Intro',
                        'body' => 'Privacy policy body',
                    ),
                    array(
                        // GDPR policy, ID = 3
                        'description' => 'Corporate GDPR terms',
                        'title' => 'GDPR',
                        'lead' => 'GDPR Intro',
                        'body' => 'GDPR terms text',
                    )
                )
            );
        }
    }
}
