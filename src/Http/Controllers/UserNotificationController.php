<?php

namespace Eutranet\Corporate\Http\Controllers;

use App\Http\Controllers\Controller;
use Eutranet\Corporate\Traits\BackendNotificationTrait;
use Eutranet\Corporate\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class UserNotificationController extends Controller
{
    use BackendNotificationTrait;

    public function create(User $user): Factory|View|Application
    {
//
        //		Schema::create('notification_templates', function (Blueprint $table) {
        //			$table->bigIncrements('id');
        //			$table->string('package_name', 50)->nullable()->default('NULl');
        //			$table->longText('name')->nullable();
        //			$table->longText('message')->nullable();
        //			$table->longText('action')->nullable();
        //			$table->string('url')->nullable()->default('NULl');
        //			$table->longText('description')->nullable();
        //			$table->boolean('is_active')->nullable()->default(true);
        //			$table->nullableTimestamps();
        //			$table->softDeletes();
        //		});
//
        //		DB::table('notification_templates')->insert(
        //			array(
        //				[
        //					'package_name' => 'be',
        //					'name' => '{"en":"We cannot reach you", "fr":"Nous ne parvenons pas à vous joindre.", "pt":"Não conseguimos contactá-lo. Por favor, mantenha-se em contacto"}',
        //					'message' => '{"en":"We cannot reach you", "fr":"Nous ne parvenons pas à vous joindre.", "pt":"Não conseguimos contactá-lo. Por favor, mantenha-se em contacto"}',
        //					'action' => '{"en":"Please contact us", "fr":"Veuillez nous contacter, svp !", "pt":"Contacte-nos !"}',
        //					'url' => 'hello-we-cannot-reach-you',
        //					'description' => '{"en":"Send this notification if you cannot reach the user by phone. He or she will receive an email...", "pt":"Enviar esta notificação se não conseguir contactar o utilizador por telefone. Ele ou ela receberá um e-mail...", "fr":"Envoyez cette notification si vous ne pouvez pas joindre l\'utilisateur par téléphone. Il ou elle recevra un courriel..."}',
        //					"is_active" => true,
        //				],
        //			)
        //		);
        return view('corporate::user-notifications.create', ['user' => $user]);
    }
}
