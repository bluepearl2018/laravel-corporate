<?php

namespace Eutranet\Corporate\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class NotificationTemplate extends Model implements HasMedia
{
    use HasTranslations;
    use InteractsWithMedia;
    use SoftDeletes;

    /**
     * Agreements are UNSIGNED PDF agreement templates
     */
    protected $table = "notification_templates";
    protected $fillable = ['package_name', 'name', 'message', 'action', 'url', 'description', 'is_active'];
    protected array $translatable = ['name', 'message', 'action', 'description' ];
    protected $casts = [
        'is_active' => 'boolean'
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
        return trans('Templates for quick user-notifications.');
    }

    public function getFields()
    {
        // field, type, required, placeholder, tip, model for select
        return [
            'package_name' => ['input', 'text', 'required', trans('feedbacks.Package name'), trans('feedbacks.Enter the package name')],
            'name' => ['input', 'text', 'required', trans('feedbacks.Agreement name'), trans('feedbacks.Enter the agreement name')],
            'message' => ['input', 'textarea', 'required', trans('feedbacks.Description'), trans('feedbacks.Enter the description')],
            'action' => ['input', 'text', 'required', trans('feedbacks.Action button text'), trans('feedbacks.Enter the action text string')],
            'url' => ['input', 'text', 'required', trans('feedbacks.Route name'), trans('feedbacks.According to target guard...')],
            'description' => ['input', 'textarea', 'required', trans('feedbacks.Description'), trans('feedbacks.Enter the description')],
            'is_active' => ['checkbox', 'option', 'optional', trans('feedbacks.Available to be used ?'), trans('feedbacks.Check if true')],
        ];
    }
}
