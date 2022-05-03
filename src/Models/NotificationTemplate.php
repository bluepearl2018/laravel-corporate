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
            'package_name' => ['input', 'text', 'required', 'Package name', 'Enter the package name'],
            'name' => ['input', 'text', 'required', 'Agreement name', 'Enter the agreement name'],
            'message' => ['input', 'textarea', 'required', 'Description', 'Enter the description'],
            'action' => ['input', 'text', 'required', 'Action button text', 'Enter the action text string'],
            'url' => ['input', 'text', 'required', 'Route name', 'According to target guard...'],
            'description' => ['input', 'textarea', 'required', 'Description', 'Enter the description'],
            'is_active' => ['checkbox', 'option', 'optional', 'Available to be used ?', 'Check if true'],
        ];
    }
}
