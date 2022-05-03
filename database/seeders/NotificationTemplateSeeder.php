<?php

namespace Eutranet\Corporate\Database\Seeders;

use Illuminate\Database\Seeder;
use Eutranet\Corporate\Database\Factories\StaffMemberUserFactory;
use Database\Factories\UserFactory;
use Illuminate\Support\Facades\DB;

class NotificationTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('notification_templates')->get()->count() < 1) {
            DB::table('notification_templates')->insert(
                array(
                [
                    'package_name' => 'be',
                    'name' => '{"en":"We cannot reach you", "fr":"Nous ne parvenons pas à vous joindre.", "pt":"Não conseguimos contactá-lo. Por favor, mantenha-se em contacto"}',
                    'message' => '{"en":"We cannot reach you", "fr":"Nous ne parvenons pas à vous joindre.", "pt":"Não conseguimos contactá-lo. Por favor, mantenha-se em contacto"}',
                    'action' => '{"en":"Please contact us", "fr":"Veuillez nous contacter, svp !", "pt":"Contacte-nos !"}',
                    'url' => 'hello-we-cannot-reach-you',
                    'description' => '{"en":"Send this notification if you cannot reach the user by phone. He or she will receive an email...", "pt":"Enviar esta notificação se não conseguir contactar o utilizador por telefone. Ele ou ela receberá um e-mail...", "fr":"Envoyez cette notification si vous ne pouvez pas joindre l\'utilisateur par téléphone. Il ou elle recevra un courriel..."}',
                    "is_active" => true,
                ],
            )
            );
        }
    }
}
