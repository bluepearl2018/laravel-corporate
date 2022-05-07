<?php

namespace Eutranet\Corporate\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class StaffMember extends \Eutranet\Setup\Models\StaffMember
{
    use HasRoles;

	/**
	 * Get the agency where the staff belongs to
	 *
	 * @return BelongsTo
	 */
	public function agency(): BelongsTo
	{
		return $this->belongsTo(Agency::class, 'agency_id');
	}

	/**
	 * Get the agency where the staff belongs to
	 *
	 * @return BelongsToMany
	 */
	public function users(): BelongsToMany
	{
		return $this->belongsToMany(User::class, StaffPortfolio::class);
	}

	/**
	 * Get the consultations assigned to a staff member
	 *
	 * @return HasMany
	 */
	public function consultations(): HasMany
	{
		return $this->hasMany(Consultation::class, 'consultant_id');
	}

	/**
	 * A staff member belongs to many teams
	 * @return BelongsToMany
	 */
	public function corporate(): BelongsToMany
	{
		return $this->belongsToMany(Corporate::class, CorporateStaffMember::class);
	}

	/**
	 * A staff member belongs to many teams
	 * @return BelongsToMany
	 */
	public function teams(): BelongsToMany
	{
		return $this->belongsToMany(Team::class, StaffTeam::class);
	}
}
