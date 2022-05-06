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
	    return 'Corporate agreementCorporate agreements are an integral part of your company documentation. They are legally binding contracts that summarize strategic arrangements between your company and other parties and agents such as suppliers and partners.';
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
            'name' => ['input', 'text', 'required', 'Agreement name', 'Enter the agreement name'],
            'lead' => ['input', 'textarea', 'required', 'Intro', 'Enter an intro'],
            'description' => ['input', 'textarea', 'required', 'Description', 'Enter the description'],
            'general_terms' => ['input', 'textarea', 'required', 'General terms', 'Paste the general terms here']
        ];
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
