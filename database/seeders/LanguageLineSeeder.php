<?php

namespace Eutranet\Corporate\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;

class LanguageLineSeeder extends Seeder
{
	public array $lls = [
		array('group' => 'fields', 'key' => 'expense_category_id', 'text' => '{"en":"Expense Category", "pt":"Categoria de despesa"}'),
		array('group' => 'fields', 'key' => 'amount', 'text' => '{"en":"Amount", "pt":"Valor"}'),
		array('group' => 'fields', 'key' => 'name', 'text' => '{"en":"Name", "pt":"Nome", "fr":"Nom"}'),
		array('group' => 'fields', 'key' => 'phone', 'text' => '{"en":"Phone", "pt":"Telefone", "fr":"Téléphone"}'),

		array('group' => 'fields', 'key' => 'body', 'text' => '{"en":"Contact attempt feedback", "pt":"Feedback da tentativa de contato"}'),
		array('group' => 'fields', 'key' => 'success', 'text' => '{"en":"I succeeded", "pt":"Consegui"}'),
		array('group' => 'contact-attempts', 'key' => 'Did you manage to contact the person?', 'text' => '{"en":"Did you manage to contact the person?", "pt":"Conseguiu contatar a pessoa ?"}'),
		array('group' => 'contact-attempts', 'key' => 'The ID of the logged in staff', 'text' => '{"en":"The ID of the logged in staff", "pt":"O ID do membro da equipa"}'),
		array('group' => 'contact-attempts', 'key' => 'The ID of the contacted user', 'text' => '{"en":"The ID of the contacted user", "pt":"O ID do usuario contatado"}'),
		array('group' => 'contact-attempts', 'key' => 'Check if you succeeded. Leave blank if you did not manage to contact the person. Then SAVE.', 'text' => '{"en":"Check if you succeeded. Leave blank if you did not manage to contact the person. Then SAVE.", "pt":"Verifique se foi bem sucedido. Deixe em branco se não tiver conseguido contactar a pessoa."}'),

		array('group' => 'consultations', 'key' => 'Select the agency', 'text' => '{"en":"Select the agency", "pt":"Seleccione uma agencia da lista"}'),
		array('group' => 'consultations', 'key' => 'Pick a consultant / staff member from the list', 'text' => '{"en":"Pick a consultant / staff member from the list", "pt":"Escolha um consultor / membro do pessoal da lista"}'),
		array('group' => 'consultations', 'key' => 'Straight to the point. 2 or 3 lines, please...', 'text' => '{"en":"Straight to the point. 2 or 3 lines, please...", "pt":"Directo ao assunto. 2 ou 3 linhas, por favor..."}'),
		array('group' => 'consultations', 'key' => 'Please pick the consultation date', 'text' => '{"en":"Please pick the consultation date", "pt":"Por favor escolha a data da consulta"}'),
		array('group' => 'consultations', 'key' => 'Please pick the consultation time', 'text' => '{"en":"Straight to the point. 2 or 3 lines, please...", "pt":"Por favor escolha a hora da consulta"}'),

		array('group' => 'feedbacks', 'key' => 'It is a memo. Not too long, please!', 'text' => '{"en":"It is a memo. Not too long, please!", "pt":"É um memorando. Não demasiado tempo, por favor!"}'),

	];

	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		static::saveTranslations($this->lls);
	}

	public static function saveTranslations($lls)
	{

		if (\Schema::hasTable('language_lines')) {
			foreach ($lls as $ll) {
				if (!LanguageLine::where([
					'group' => $ll['group'],
					'key' => $ll['key']
				])->get()->first()) {
					LanguageLine::create([
						'group' => $ll['group'],
						'key' => $ll['key'],
						'text' => json_decode($ll['text'], true)
					]);
				};
			}
		}
	}

}
