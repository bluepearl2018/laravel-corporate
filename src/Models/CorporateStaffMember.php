<?php

namespace Eutranet\Corporate\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

/**
 * The CorporateStaffMember class is a pivot table in order to place staffs into corporate.
 */
class CorporateStaffMember extends Model
{
    /**
     * @var string
     */
    protected $table = 'corporate_staff_member';
    protected $fillable = ['corporate_id', 'staff_member_id'];

    /**
     * Get fields for the laravel-corporate staff form generator
     */
    public static function getFields(): array
    {
        // field, type, required, placeholder, tip, model for select
        return [
            'corporate_id' => ['select', 'list', 'required', trans('corporate-staff-member.Corporate'), trans('corporate-staff-member.Select the laravel-corporate.'), 'Eutranet\Corporate\Models\Corporate'],
            'staff_member_id' => ['select', 'list', 'required', trans('corporate-staff-member.StaffMember'), trans('corporate-staff-member.Select the staff member.'), 'Eutranet\Setup\Models\StaffMember'],
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
        return 'Corporate staff.';
    }

    /**
     * To be able to instantiate the right Model from our laravel-init
     * with the factory() method, we need to add the following
     * method to our model:
     * @return CorporateStaffFactory
     */
    protected static function newFactory(): CorporateStaffFactory
    {
        return CorporateStaffFactory::new();
    }

    /**
     * @return BelongsTo
     */
    public function corporate(): BelongsTo
    {
        return $this->belongsTo(Corporate::class);
    }

    /**
     * @return BelongsTo
     */
    public function staffMember(): BelongsTo
    {
        return $this->belongsTo(StaffMember::class);
    }
}
