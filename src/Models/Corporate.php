<?php

namespace Eutranet\Corporate\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Eutranet\Commons\Models\Country;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Corporate class to describe and save a laravel-corporate, in order to add agencies or branch offices
 * It has a corporte_id, which, by default, = 1 or the coporate ID.
 */
class Corporate extends Model implements HasMedia
{
    use HasTranslations;
    use InteractsWithMedia;
    use SoftDeletes;

    protected $table = "corporates";

    protected $fillable = [
        'name', 'address1', 'address2',
        'postal_code', 'city', 'council', 'district',
        'country_id', 'phone', 'mobile', 'latitude', 'longitude',
        'email', 'email_private', 'twitter', 'youtube', 'instagram',
        'facebook', 'linkedin', 'lead', 'description', 'body', 'is_active'
    ];
    /**
     * Lead and body are made translatable
     */
    protected array $translatable = [
        'lead', 'description', 'body'
    ];

    /**
     * Get fields for the laravel-corporate form generator
     */
    public static function getFields(): array
    {
        // field, type, required, placeholder, tip, model for select
        return [
            'name' => ['input', 'text', 'required', trans('corporates.Corporate Name'), trans('corporates.Enter the laravel-corporate name')],
            'address1' => ['input', 'text', 'required', trans('corporates.Address first line'), trans('corporates.Max 35 chars.')],
            'address2' => ['input', 'text', 'optional', trans('corporates.Address second line'), trans('corporates.Max 35 chars.')],
            'postal_code' => ['input', 'text', 'required', trans('corporates.Postal code'), trans('corporates.Enter the postal code.')],
            'city' => ['input', 'text', 'required', trans('corporates.city'), trans('corporates.Enter the city name.')],
            'council' => ['input', 'text', 'optional', trans('corporates.Council'), trans('corporates.Enter the council name.')],
            'district' => ['input', 'text', 'optional', trans('corporates.District'), trans('corporates.Enter the district name.')],
            'country_id' => ['select', 'list', 'required', trans('corporates.Country'), trans('corporates.Select a country from the list.'), '\Eutranet\Commons\Models\Country'],
            'phone' => ['input', 'phone', 'required', trans('corporates.Phone'), trans('corporates.Format should be like +351.123456789')],
            'mobile' => ['input', 'phone', 'optional', trans('corporates.Mobile'), trans('corporates.Format should be like +351.123456789')],
            'latitude' => ['input', 'text', 'optional', trans('corporates.Latitude'), trans('corporates.Enter the latitude in decimal format')],
            'longitude' => ['input', 'text', 'optional', trans('corporates.longitude'), trans('corporates.Enter the longitude in decimal format')],
            'lead' => ['input', 'textarea', 'optional', trans('corporates.Lead'), trans('corporates.Enter a short intro')],
            'description' => ['input', 'textarea', 'optional', trans('corporates.Description'), trans('corporates.Enter the description')],
            'body' => ['input', 'textarea', 'optional', trans('corporates.body'), trans('corporates.Enter a long description here.')],
            //'email' => ['input', 'email', 'required', trans('corporates.Email'), trans('corporates.Enter a public email here')],
            'email_private' => ['input', 'email', 'optional', trans('corporates.Email (private)'), trans('corporates.Enter a private email here')],
            'is_active' => ['checkbox', 'option', 'optional', trans('corporates.Is active'), trans('corporates.Check if true')],
        ];
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

    public static function getClassLead(): string
    {
        return trans('corporates.class-lead');
    }

    /**
     * To be able to instantiate the right Model from our laravel-init
     * with the factory() method, we need to add the following
     * method to our model:
     * @return CorporateFactory
     */
    protected static function newFactory(): CorporateFactory
    {
        return CorporateFactory::new();
    }

    /**
     * A media collection to attach images to corporates
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('corporates');
    }

    /**
     * Get agencies / branch offices for the laravel-corporate
     *
     * @return HasMany
     */
    public function agencies(): HasMany
    {
        return $this->hasMany(Agency::class);
    }

    /**
     * Get the staffs for this corporate
     *
     * @return BelongsToMany
     */
    public function staffMembers(): BelongsToMany
    {
        return $this->BelongsToMany(StaffMember::class, CorporateStaffMember::class);
    }

    /**
     * Get the country where the laravel-corporate belongs to
     *
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
