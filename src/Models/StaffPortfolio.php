<?php

namespace Eutranet\Corporate\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;
use Eutranet\Corporate\Database\Factories\StaffPortfolioFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * The StaffPortfolio class is a pivot table to create StaffMember user portfolios
 */
class StaffPortfolio extends Model
{
    use SoftDeletes;

    protected $table = "staff_portfolio";
    protected $fillable = [
        'staff_member_id',
        'user_id'
    ];

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
     * @return StaffPortfolioFactory
     */
    protected static function newFactory(): StaffPortfolioFactory
    {
        return StaffPortfolioFactory::new();
    }

    /**
     * Get the user
     * @return BelongsTo
     *
     */
    public function user(): BelongsTo
    {
	    return $this->belongsTo(User::class);
    }

    /**
     * Get the staff
     * @return BelongsTo
     *
     */
    public function staffMember(): BelongsTo
    {
        return $this->belongsTo(StaffMember::class);
    }
}
