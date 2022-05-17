<?php

namespace Eutranet\Corporate\Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Eutranet\Corporate\Models\Agency;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $firstAgency = [
                'id' => '1',
                'corporate_id' => '1',
                'name' => 'Name of Agency',
                'code' => 'PVAlmada ',
                'zone' => 'Almada',
                'nif' => '508780845',
                'address1' => 'Rua de Vale Figueira, nº 30',
                'address2' => null,
                'postal_code' => '2800-029',
                'city' => 'Almada',
                'council' => 'Lisboa',
                'district' => 'Lisboa',
                'country_id' => '183',
                'phone' => '212 549 700',
                'mobile' => '913296768',
                'latitude' => '51.505',
                'longitude' => '-0.09',
                'email_private' => 'bibl.mun.alm@cm-almada.pt',
                'lead' => '{"en":"orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."}',
                'description' => '{"en":"Agency of Almada"}',
                'body' => '{"en":""On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.""}',
                'role_id' => '2',
                'admin_id' => null,
                'is_active' => '1',
                'created_at' => null,
                'updated_at' => '2022-04-16 15:45:33',
                'deleted_at' => null,
            ];
        $agenciesArray = [
            [
                'id' => '2',
                'name' => 'Name of Agency',
                'code' => 'PVAmadora ',
                'zone' => 'Amadora',
                'nif' => '509170633',
                'role_id' => 2, // StaffMember role
                'admin_id' => null, // Since agents are Eutranet\Setup\Models\StaffMember::class
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => '3',
                'name' => 'Name of Agency',
                'code' => 'PVAreosa ',
                'zone' => 'Areosa',
                'nif' => ' ',
                'role_id' => 2, // StaffMember role
                'admin_id' => null, // An agency should be created by an administrator
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => '4',
                'name' => 'Name of Agency',
                'code' => 'PVBraga ',
                'zone' => 'Braga',
                'nif' => null,
                'role_id' => 2,
                'admin_id' => null, // An agency should be created by an administrator
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => '5',
                'name' => 'Name of Agency',
                'code' => 'PVCentral ',
                'zone' => 'PV Central',
                'nif' => null,
                'role_id' => 2,
                'admin_id' => null, // An agency should be created by an administrator
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => '6',
                'name' => 'Name of Agency',
                'code' => 'PVCoimbra ',
                'zone' => 'Coimbra',
                'nif' => null,
                'role_id' => 2,
                'admin_id' => null, // An agency should be created by an administrator
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => '7',
                'name' => 'Name of Agency',
                'code' => 'PVCRainha ',
                'zone' => 'Caldas da Rainha',
                'nif' => null,
                'role_id' => 2,
                'admin_id' => null, // An agency should be created by an administrator
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => '8',
                'name' => 'Name of Agency',
                'code' => 'PVElvas ',
                'zone' => 'Elvas',
                'nif' => null,
                'role_id' => 2,
                'admin_id' => null, // An agency should be created by an administrator
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => '9',
                'name' => 'Name of Agency',
                'code' => 'PVEXAmadora ',
                'zone' => 'EXAMADORA',
                'nif' => null,
                'role_id' => 2,
                'admin_id' => null, // An agency should be created by an administrator
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => '10',
                'name' => 'Name of Agency',
                'code' => 'PVEXPortim&#227;o ',
                'zone' => 'EX-Portimão',
                'nif' => null,
                'role_id' => 2,
                'admin_id' => null, // An agency should be created by an administrator
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => '11',
                'name' => 'Name of Agency',
                'code' => 'PVEXPortimão ',
                'zone' => 'EXPortimão',
                'nif' => null,
                'role_id' => 2,
                'admin_id' => null, // An agency should be created by an administrator
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => '12',
                'name' => 'Name of Agency',
                'code' => 'PVExpoSul ',
                'zone' => 'Expo-Sul',
                'nif' => null,
                'role_id' => 2,
                'admin_id' => null, // An agency should be created by an administrator
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => '13',
                'name' => 'Name of Agency',
                'code' => 'PVFamalicao ',
                'zone' => 'Famalicão',
                'nif' => '509067450',
                'role_id' => 2, // StaffMember role
                'admin_id' => null, // An agency should be created by an administrator
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => '14',
                'name' => 'Name of Agency',
                'code' => 'PVFaro ',
                'zone' => 'Faro',
                'nif' => null,
                'role_id' => 2,
                'admin_id' => null, // An agency should be created by an administrator
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => '15',
                'name' => 'Name of Agency',
                'code' => 'PVGaia ',
                'zone' => 'Vila Nova de Gaia',
                'nif' => null,
                'role_id' => 2,
                'admin_id' => null, // An agency should be created by an administrator
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => '16',
                'name' => 'Name of Agency',
                'code' => 'PVLeiria ',
                'zone' => 'Leiria',
                'nif' => null,
                'role_id' => 2,
                'admin_id' => null, // An agency should be created by an administrator
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => '17',
                'name' => 'Name of Agency',
                'code' => 'PVLoures ',
                'zone' => 'Loures',
                'nif' => null,
                'role_id' => 2,
                'admin_id' => null, // An agency should be created by an administrator
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => '18',
                'name' => 'Name of Agency',
                'code' => 'PVMaia ',
                'zone' => 'Maia',
                'nif' => null,
                'role_id' => 2,
                'admin_id' => null, // An agency should be created by an administrator
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => '19',
                'name' => 'Name of Agency',
                'code' => 'PVMapfre ',
                'zone' => 'Mapfre - Porto',
                'nif' => '505448880',
                'role_id' => 2, // StaffMember role
                'admin_id' => null, // An agency should be created by an administrator
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => '20',
                'name' => 'Name of Agency',
                'code' => 'PVMatosinhos ',
                'zone' => 'Matosinhos',
                'nif' => ' ',
                'role_id' => 2, // StaffMember role
                'admin_id' => null, // An agency should be created by an administrator
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => '21',
                'name' => 'Name of Agency',
                'code' => 'PVOdivelas ',
                'zone' => 'Odivelas',
                'nif' => '509171818',
                'role_id' => 2, // StaffMember role
                'admin_id' => null, // An agency should be created by an administrator
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => '22',
                'name' => 'Name of Agency',
                'code' => 'PVOeiras ',
                'zone' => 'Oeiras',
                'nif' => null,
                'role_id' => 2,
                'admin_id' => null, // An agency should be created by an administrator
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => '23',
                'name' => 'Name of Agency',
                'code' => 'PVOurem ',
                'zone' => 'Ourém',
                'nif' => null,
                'role_id' => 2,
                'admin_id' => null, // An agency should be created by an administrator
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => '24',
                'name' => 'Name of Agency',
                'code' => 'PVParedes ',
                'zone' => 'Paredes',
                'nif' => null,
                'role_id' => 2,
                'admin_id' => null, // An agency should be created by an administrator
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => '25',
                'name' => 'Name of Agency',
                'code' => 'PVPortimao ',
                'zone' => 'Portimão',
                'nif' => null,
                'role_id' => 2,
                'admin_id' => null, // An agency should be created by an administrator
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => '26',
                'name' => 'Name of Agency',
                'code' => 'PVPorto ',
                'zone' => 'Porto',
                'nif' => null,
                'role_id' => 2,
                'admin_id' => null, // An agency should be created by an administrator
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => '27',
                'name' => 'Name of Agency',
                'code' => 'PVSetubal ',
                'zone' => 'Setubal',
                'nif' => null,
                'role_id' => 2,
                'admin_id' => null, // An agency should be created by an administrator
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => '28',
                'name' => 'Name of Agency',
                'code' => 'PVSintra ',
                'zone' => 'Sintra',
                'nif' => null,
                'role_id' => 2,
                'admin_id' => null, // An agency should be created by an administrator
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => '29',
                'name' => 'Name of Agency',
                'code' => 'PVTeste ',
                'zone' => 'PvTeste',
                'nif' => null,
                'role_id' => 2,
                'admin_id' => null, // An agency should be created by an administrator
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => '30',
                'name' => 'Name of Agency',
                'code' => 'PVTNovas ',
                'zone' => 'Torres Novas',
                'nif' => null,
                'role_id' => 2,
                'admin_id' => null, // An agency should be created by an administrator
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => '31',
                'name' => 'Name of Agency',
                'code' => 'PVValongo ',
                'zone' => 'Valongo',
                'nif' => null,
                'role_id' => 2,
                'admin_id' => null, // An agency should be created by an administrator
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
        ];

        if (DB::table('agencies')->get()->count() < 1) {
			DB::table('agencies')->insert(
				$firstAgency
            );
        }
	    if (DB::table('agencies')->get()->count() < 2) {
		    DB::table('agencies')->insert(
			    $agenciesArray
		    );
	    }
	    if (DB::table('agencies')->get()->count() > 0) {
			foreach(Agency::all() as $agency)
			{
				$agency->update(['name' => $agency->code]);
			}
	    }
    }
}
