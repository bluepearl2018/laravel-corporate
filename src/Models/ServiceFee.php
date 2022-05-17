<?php

namespace Eutranet\Corporate\Models;

use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\ArrayShape;
use Spatie\Translatable\HasTranslations;

class ServiceFee extends Model
{
    use HasTranslations;

    protected $table = "service_fees";
    protected $fillable = [
        'slug',
        'name',
        'description',
        'amount',
    ];
    protected array $translatable = [
        'name',
        'description'
    ];

    #[ArrayShape(['slug' => "string[]", 'name' => "string[]", 'description' => "string[]", 'amount' => "string[]"])]
    public static function getFields(): array
    {
        // field, type, required, placeholder, tip, model for select
        return [
            'slug' => ['input', 'text', 'required', trans('feedbacks.Slug'), trans('feedbacks.Enter the slug (max. 255 chars)')],
            'name' => ['input', 'text', 'required', trans('feedbacks.Name'), trans('feedbacks.Enter the name')],
            'description' => ['input', 'textarea', 'required', trans('feedbacks.Description'), trans('feedbacks.Enter the description')],
            'amount' => ['input', 'textarea', 'required', trans('feedbacks.Lead'), trans('feedbacks.Enter the lead / intro')],
        ];
    }

    public static function getClassLead(): string
    {
        return '';
    }

    /**
     * This static function is essential for the documentation service provider
     * The namespace is saved into doc_models table
     * @return string
     */
    public static function getNamespace(): string
    {
        return __NAMESPACE__;
    }

    /**
     * To be able to instantiate the right Model from our laravel-init
     * with the factory() method, we need to add the following
     * method to our model:
     * @return ServiceFeeFactory
     */
    protected static function newFactory(): ServiceFeeFactory
    {
        return ServiceFeeFactory::new();
    }
}
