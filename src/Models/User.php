<?php

namespace Eutranet\Corporate\Models;

use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Database\Eloquent\Model;
use Eutranet\Commons\Models\UserStatus;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Eutranet\Corporate\Http\Controllers\StaffPortfolioController;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 *
 */
class User extends Model implements HasMedia
{
    use Notifiable;
    use InteractsWithMedia;

    /**
     * @var string
     */
    protected $table = "users";

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->mergeFillable([
            'user_status_id',
            'has_accepted_general_terms_on',
            'has_accepted_my_space_general_terms_on',
            'account_deletion_request_received_on',
            'troublemaking_score',
            'is_valid',
            'is_locked',
            'nif',
            'phone',
            'email',
            'country_id',
        ]);
    }

    /**
     * @var string[]
     */
    protected $casts = [
        'is_valid' => 'boolean',
        'is_locked' => 'boolean',
        'has_accepted_general_terms_on' => 'datetime',
        'has_accepted_my_space_generaL_term_on' => 'datetime',
        'account_deletion_request_received_on' => 'datetime',
    ];

    /**
     * @return string
     */
    public static function getClassLead(): string
    {
        return trans('Users registered in this application have an account. Access is granted via fontend login. 
		The account remains locked until acceptation of any kind general terms. In this case, the account holder 
		does not access advanced functions of the dashboard.');
    }

    /**
     * @return string[][]
     */
    #[ArrayShape(['email' => "string[]", 'name' => "string[]", 'phone' => "string[]", 'nif' => "string[]", 'country_id' => "string[]"])]
    public static function getFields(): array
    {
        return [
            'name' => ['input', 'text', 'required', trans('users.Account Name'), trans('users.This is the account name')],
            'email' => ['input', 'email', 'required', trans('users.Account email'), trans('users.This MUST NOT be deleted or updated')],
            'phone' => ['input', 'phone', 'required', trans('users.Phone'), trans('users.Enter or update a phone number')],
            'nif' => ['input', 'pttaxid', 'required', trans('users.Tax ID'), trans('users.Tax id')],
            'country_id' => ['select', 'list', 'required', trans('users.Country'), trans('users.Select a country'), 'Eutranet\Commons\Models\Country'],
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

    /**
     * A media collection to attach images to model docs
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('users');
    }

    /**
     * Always encrypt the password when it is updated.
     *
     * @param $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * @return BelongsTo
     */
    public function userStatus(): BelongsTo
    {
        return $this->belongsTo(UserStatus::class);
    }

	/**
	 * @return HasMany
	 */
	public function feedbacks(): HasMany
	{
		return $this->hasMany(Feedback::class);
	}

	/**
	 * @return HasMany
	 */
	public function consultations(): HasMany
	{
		return $this->hasMany(Consultation::class);
	}

	/**
	 * @return HasMany
	 */
	public function contactAttempts(): HasMany
	{
		return $this->hasMany(ContactAttempt::class);
	}

	/**
	 * @return BelongsToMany
	 */
	public function staffMembers(): BelongsToMany
	{
		return $this->belongsToMany(StaffMember::class, StaffPortfolio::class);
	}
}
