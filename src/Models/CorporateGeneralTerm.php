<?php

namespace Eutranet\Corporate\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;
use JetBrains\PhpStorm\ArrayShape;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Eutranet\Setup\Models\Admin;
use Eutranet\Corporate\Database\Factories\CorporateGeneralTermFactory;
use Eutranet\Setup\Models\GeneralTerm;

/**
 * GeneralTerm and its table are to store laravel-corporate general terms.
 * This should implement HasMedia in order to retrieve PDF
 */
class CorporateGeneralTerm extends GeneralTerm implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    use SoftDeletes;

    protected $table = "corporate_general_terms";
    protected $fillable = [
        'corporate_id',
        'title',
        'description',
        'lead',
        'body',
        'admin_id'
    ];

    protected array $translatable = [
        'title',
        'description',
        'lead',
        'body'
    ];

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
        return trans('corporate-general-terms.Terms and conditions are aimed at protecting the business (you). They give business owners the opportunity to set their rules (within applicable law) of how their service or product may be used including, but not limited to, things like copyright conditions, age limits, and the governing law of the contract.');
    }

    #[ArrayShape(['corporate_id' => "string[]", 'title' => "string[]", 'description' => "string[]", 'lead' => "string[]", 'body' => "string[]", 'file_path' => "string[]"])]
    public static function getFields(): array
    {
        // field, type, required, placeholder, tip, model for select
        return [
            'title' => ['input', 'textarea', 'required', trans('corporate-general-terms.Title'), trans('corporate-general-terms.Enter the title')],
            'lead' => ['input', 'textarea', 'required', trans('corporate-general-terms.Lead'), trans('corporate-general-terms.Enter the lead / intro')],
            'body' => ['input', 'textarea', 'required', trans('corporate-general-terms.Body'), trans('corporate-general-terms.Enter the body')],
            'file_path' => ['input', 'file', 'optional', trans('corporate-general-terms.PDF version'), trans('corporate-general-terms.Get a PDF from you preferred folder')],
	        'description' => ['input', 'textarea', 'required', trans('corporate-general-terms.Description'), trans('corporate-general-terms.Enter the description')],
	        'corporate_id' => ['select', 'list', 'required', trans('corporate-general-terms.Corporate'), trans('corporate-general-terms.Select the corporate'), 'Eutranet\Corporate\Models\Corporate'],
        ];
    }

    /**
     * To be able to instantiate the right Model from our laravel-init
     * with the factory() method, we need to add the following
     * method to our model:
     * @return CorporateGeneralTermFactory
     */
    protected static function newFactory(): CorporateGeneralTermFactory
    {
        return CorporateGeneralTermFactory::new();
    }

    /**
     * Create a media collection for general terms
     * In other words, to attach A pdf or several versions to a genral term item
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('laravel-corporate-corporate-general-terms');
    }

    /**
     * Create a media collection for general terms
     * In other words, to attach A pdf or several versions to a genral term item
     * @return BelongsTo
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }
}
