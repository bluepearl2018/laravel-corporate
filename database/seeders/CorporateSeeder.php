<?php

namespace Eutranet\Corporate\Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CorporateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultCorporate = array(
            [
                'id' => '1',
                'name' => 'Eutranet',
                'address1' => 'The online world',
                'address2' => null,
                'postal_code' => '123-456789',
                'city' => 'Oporto',
                'council' => null,
                'district' => null,
                'country_id' => '183',
                'phone' => '222123456',
                'mobile' => '913296767',
                'latitude' => '51.45',
                'longitude' => '-7.45',
                'youtube' => 'youtube',
                'twitter' => 'twitter',
                'instagram' => 'instagram',
                'linkedin' => 'linkedin',
                'facebook' => 'facebook',
                'email' => 'company@company.tld',
                'email_private' => 'private@company.tld',
                'lead' => '{"en":"A modern soft developement coporate", "fr":"Une entreprise moderne de développmemnt de logiciels", "pt":"Uma empresa moderna de desenvolvimento de software."}',
                'description' => null,
                'body' => '{"en":"Eutranet is accessible online", "fr":"Eutranet est accessible en ligne.", "pt":"Eutranet está disponível online."}',
                'is_active' => '0',
                'created_at' => '2000-01-01 12:00:01',
                'updated_at' => '2000-01-01 12:05:01',
                'deleted_at' => null,
            ],
        );
        if (DB::table('corporates')->get()->count() < 1) {
            DB::table('corporates')->insert(
                $defaultCorporate
            );
        }
    }
}
