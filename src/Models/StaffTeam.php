<?php

namespace Eutranet\Corporate\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * The StaffTeam class is a pivot table in order to place staffs into teams.
 */
class StaffTeam extends Pivot
{
    /**
     * @var string
     */
    protected $table = 'staff_team';

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
     * @return StaffTeamFactory
     */
    protected static function newFactory(): StaffTeamFactory
    {
        return StaffTeamFactory::new();
    }

    /**
     * @return BelongsTo
     */
    public function staffMember(): BelongsTo
    {
        return $this->belongsTo(StaffMember::class);
    }

    /**
     * @return BelongsTo
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
