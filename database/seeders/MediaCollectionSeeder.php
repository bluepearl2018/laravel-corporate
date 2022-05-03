<?php

namespace Eutranet\Corporate\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Eutranet\Commons\Models\MaritalStatus;
use Eutranet\Commons\Models\MatrimonialRegime;
use Illuminate\Support\Facades\Schema;
use Eutranet\Commons\Models\MediaCollection;

class MediaCollectionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $demoArray = array(
            array(
                'package' => 'eutranet/laravel-corporate',
                'code' => 'be',
                'name' => '{"en":"User Account Agreements", "fr":"Contrat de comptes d\'utilisation", "pt":"Contrato da conta"}',
                'description' => null,
                'class_route' => 'account-agreements',
            ),
        );
        if (Schema::hasTable('media_collections')) {
            if (MediaCollection::where('code', 'be')->get()->first() === null) {
                DB::table('media_collections')->insert(
                    $demoArray
                );
            }
        }
    }
}
