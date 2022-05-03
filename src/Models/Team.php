<?php

namespace Eutranet\Corporate\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Translatable\HasTranslations;

/**
 * The Team class is made to describe and save teams.
 * A team should be created by an administrator.
 */
class Team extends Model implements HasMedia
{
    use HasTranslations;
    use InteractsWithMedia;
    use HasFactory;
    use HasRoles;
    use SoftDeletes;

    protected $table = "teams";
    protected $fillable = ['slug', 'title', 'description', 'lead', 'body', 'admin_id'];
    protected array $translatable = ['title', 'description', 'lead', 'body'];

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
     * @return TeamFactory
     */
    protected static function newFactory(): TeamFactory
    {
        return TeamFactory::new();
    }

    public function getFields()
    {
        // field, type, required, placeholder, tip, model for select
        return [
            'slug' => ['input', 'text', 'required', 'Slug', 'Enter the slug (max. 255 chars)'],
            'name' => ['input', 'text', 'required', 'Name', 'Enter the name'],
            'description' => ['input', 'textarea', 'required', 'Description', 'Enter the description'],
            'lead' => ['input', 'textarea', 'required', 'Lead', 'Enter the lead / intro'],
            'body' => ['input', 'textarea', 'required', 'Body', 'Enter the body'],
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('teams');
    }

    /**
     * A team belongs to an administrator
     *
     * @return BelongsTo
     *
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    /**
     * Pivot table StaffTeam to gather users in teams.
     *
     * @return BelongsToMany
     *
     */
    public function staffMembers(): BelongsToMany
    {
        return $this->belongsToMany(StaffMember::class, StaffTeam::class);
    }
}
