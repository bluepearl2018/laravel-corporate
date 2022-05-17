<?php

namespace Eutranet\Corporate\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;
use JetBrains\PhpStorm\ArrayShape;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Eutranet\Commons\Models\LanguageLine;

class CorporateAgreement extends Model implements HasMedia
{
    use HasTranslations;
    use InteractsWithMedia;
    use SoftDeletes;

    /**
     * Agreements are UNSIGNED PDF agreement templates
     */
    protected $table = "corporate_agreements";
    protected $fillable = ['name', 'description', 'lead', 'general_terms', 'author_id'];
    protected array $translatable = ['name', 'description', 'lead', 'general_terms']; // 'general_terms'

    /**
     * This static function is essential for the documentation service provider
     * The namespace is saved into doc_models table
     * @return string
     */
    public static function getNamespace(): string
    {
        return __NAMESPACE__;
    }

    public static function getClassLead(): string
    {
	    return trans('corporate-agreements.Corporate agreementCorporate agreements are an integral part of your company documentation. They are legally binding contracts that summarize strategic arrangements between your company and other parties and agents such as suppliers and partners.');
    }

    /**
     * To be able to instantiate the right Model from our laravel-init
     * with the factory() method, we need to add the following
     * method to our model:
     * @return CorporateAgreementFactory
     */
    protected static function newFactory(): CorporateAgreementFactory
    {
        return CorporateAgreementFactory::new();
    }

    public static function getFields()
    {
        // field, type, required, placeholder, tip, model for select
        return [
            'name' => ['input', 'text', 'required', trans('corporate-agreements.Corporate Agreement name'), trans('corporate-agreements.Enter the agreement name')],
            'lead' => ['input', 'textarea', 'required', trans('corporate-agreements.Intro'), trans('corporate-agreements.Enter an intro')],
            'description' => ['input', 'textarea', 'required', trans('corporate-agreements.Description'), trans('corporate-agreements.Enter a description')],
            'general_terms' => ['input', 'textarea', 'required', trans('corporate-agreements.General Terms'), trans('corporate-agreements.Paste the general terms here')]
        ];
    }

	public static function saveTranslations()
	{
		$lls = [
			array('group' => 'fields', 'key' => 'name', 'text' => '{"en":"Name", "pt":"Nome", "fr":"Nom"}'),
			array('group' => 'fields', 'key' => 'lead', 'text' => '{"en":"Intro", "pt":"Intro", "fr":"Intro"}'),
			array('group' => 'fields', 'key' => 'description', 'text' => '{"en":"Description", "pt":"Descrição", "fr":"Description"}'),
			array('group' => 'fields', 'key' => 'general_terms', 'text' => '{"en":"General Terms", "pt":"Ativo", "fr":"Actif"}'),
			array('group' => 'corporate-agreements', 'key' => 'Corporate Agreement name', 'text' => '{"en":"Corporate Agreement name", "pt":"Nom do contrato corporate", "fr":"Nom du contrat corporate"}'),
			array('group' => 'corporate-agreements', 'key' => 'Enter the agreement name', 'text' => '{"en":"Enter the agreement name", "pt":"Entre o nom do contrato", "fr":"Nommez le contrat."}'),
			array('group' => 'corporate-agreements', 'key' => 'Enter a description', 'text' => '{"en":"Enter a description", "pt":"Entre uma descrição", "fr":"Fournissez une description."}'),
			array('group' => 'corporate-agreements', 'key' => 'Description', 'text' => '{"en":"Description", "pt":"Descrição", "fr":"Description"}'),
			array('group' => 'corporate-agreements', 'key' => 'General Terms', 'text' => '{"en":"General Terms", "pt":"Condições gerais", "fr":"Conditions générales"}'),
			array('group' => 'corporate-agreements', 'key' => 'Paste the general terms', 'text' => '{"en":"Paste the general terms", "pt":"Copiar e colar as condições gerais (HTML).", "fr":"Copier-coller les conditions générales au format HTML."}'),

		];

		if (\Schema::hasTable('language_lines')) {
			foreach ($lls as $ll) {
				if(! LanguageLine::where([
					'group' => $ll['group'],
					'key' => $ll['key']
				])->get()->first())
				{
					LanguageLine::create([
						'group' => $ll['group'],
						'key' => $ll['key'],
						'text' => json_decode($ll['text'], true)
					]);
				};
			}
		}
	}

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('corporate-agreements');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
