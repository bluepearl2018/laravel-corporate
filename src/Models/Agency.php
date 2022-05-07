<?php

namespace Eutranet\Corporate\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Translatable\HasTranslations;
use Eutranet\Setup\Models\Admin;
use Eutranet\Setup\Models\ModelDoc;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Eutranet\Commons\Models\LanguageLine;

/**
 * Agency class is actually to describe and save a corporate branch office
 */
class Agency extends Model implements HasMedia
{
    use HasTranslations;
    use InteractsWithMedia;
    use HasFactory;
    use HasRoles;
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = "agencies";
    /**
     * @var string[]
     */
    protected $fillable = [
        "corporate_id",
        "admin_id",
        "name",
        "code",
        "zone",
        "nif",
        "role_id",
        "is_active",
        "lead",
        "body",
        "description",
    ];

    /**
     * Translatale fields to be used on a frontend part
     * @var array
     */
    protected array $translatable = [
        'lead', 'body', 'description'
    ];

    /**
     * Get fields for the agency form generator
     */
    public static function getFields(): array
    {
        // field, type, required, placeholder, tip, model for select
        return [
            'name' => ['input', 'text', 'required', trans('agency.Corporate Name'), trans('agency.Enter the laravel-corporate name')],
            'phone' => ['input', 'phone', 'required', trans('agency.Phone'), trans('agency.Format should be like +351.123456789')],
            'address1' => ['input', 'text', 'required', trans('agency.Address first line'), trans('agency.Max 35 chars.')],
            'address2' => ['input', 'text', 'optional', trans('agency.Address second line'), trans('agency.Max 35 chars.')],
            'postal_code' => ['input', 'text', 'required', trans('agency.Postal code'), trans('agency.Enter the postal code.')],
            'city' => ['input', 'text', 'required', trans('agency.city'), trans('agency.Enter the city name.')],
            'council' => ['input', 'text', 'optional', trans('agency.Council'), trans('agency.Enter the council name.')],
            'district' => ['input', 'text', 'optional', trans('agency.District'), trans('agency.Enter the district name.')],
            'mobile' => ['input', 'phone', 'optional', trans('agency.Mobile'), trans('agency.Format should be like +351.123456789')],
            'latitude' => ['input', 'text', 'optional', trans('agency.Latitude'), trans('agency.Enter the latitude in decimal format')],
            'longitude' => ['input', 'text', 'optional', trans('agency.longitude'), trans('agency.Enter the longitude in decimal format')],
            'lead' => ['input', 'textarea', 'optional', trans('agency.Lead'), trans('agency.Enter a short intro')],
            'description' => ['input', 'textarea', 'optional', trans('agency.Description'), trans('agency.Enter the description')],
            'body' => ['input', 'textarea', 'optional', trans('agency.body'), trans('agency.Enter a long description here.')],
            'corporate_id' => ['select', 'list', 'required', trans('agency.Corporate'), trans('agency.Select the laravel-corporate where the agency belongs to.'), 'Eutranet\Corporate\Models\Corporate'],
            'country_id' => ['select', 'list', 'required', trans('agency.Country'), trans('agency.Select a country from the list.'), 'Eutranet\Commons\Models\Country'],
            //'email' => ['input', 'email', 'required', trans('agency.Email'), trans('agency.Enter a public email here')],
            'email_private' => ['input', 'email', 'optional', trans('agency.Email (private)'), trans('agency.Enter a private email here')],
            'is_active' => ['checkbox', 'option', 'optional', trans('agency.Is active'), trans('agency.Check if true')],
        ];
    }

    /**
     * Fields and class translations are saved into language lines table.
     * This function is called from the static boot.
     * @return void
     */
    public static function saveTranslations()
    {
        $lls = array(
            array('group' => 'fields', 'key' => 'name', 'text' => '{"en":"Name", "pt":"Nome", "fr":"Nom"}'),
            array('group' => 'fields', 'key' => 'phone', 'text' => '{"en":"Phone", "pt":"Telefone", "fr":"Téléphone"}'),
//            array('group' => 'fields', 'key' => 'expense_category_id', 'text' => '{"en":"Expense Category", "pt":"Categoria de despesa"}'),
//            array('group' => 'fields', 'key' => 'amount', 'text' => '{"en":"Amount", "pt":"Valor"}'),
        );

        if (\Schema::hasTable('language_lines')) {
            foreach ($lls as $ll) {
                LanguageLine::firstOrCreate([
                    'group' => $ll['group'],
                    'key' => $ll['key'],
                    'text' => json_decode($ll['text'], true)
                ]);
            }
        }
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
        return trans('Our agencies provide people with excellent services according our corporate mindset.');
    }

    /**
     * To be able to instantiate the right Model from our laravel-init
     * with the factory() method, we need to add the following
     * method to our model:
     * @return AgencyFactory
     */
    protected static function newFactory(): AgencyFactory
    {
        return AgencyFactory::new();
    }

    /**
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('agencies');
    }

    /**
     * @return BelongsTo
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    /**
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * @return BelongsTo
     */
    public function corporate(): BelongsTo
    {
        return $this->belongsTo(Corporate::class);
    }

    /**
     * @return HasMany
     */
    public function staffMembers(): HasMany
    {
        return $this->hasMany(StaffMember::class);
    }

    /**
     * @return HasManyThrough
     */
    public function users(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, StaffPortfolio::class);
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        if (Schema::hasTable('model_docs')) {
            ModelDoc::firstOrCreate([
                'table_name' => (new Agency())->getTable(),
                'slug' => Str::slug((new Agency())->getTable()),
                'name' => Str::replace(Str::snake(Str::afterLast(__CLASS__, '\\')), '_', ' '),
                'namespace' => __NAMESPACE__,
                'description' => self::getClassLead(),
                'comment' => null,
                'default_role' => 'admin'
            ]);
        }
    }
}
