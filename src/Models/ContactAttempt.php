<?php

namespace Eutranet\Corporate\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;
use JetBrains\PhpStorm\ArrayShape;

/**
 * Contact Attempt to describe and save contact attemps from sales
 * This belongs to Contacts folder.
 */
class ContactAttempt extends Model
{
    use SoftDeletes;

    protected $table = "contact_attempts";
    protected $fillable = ['user_id', 'staff_member_id', 'success'];

    #[ArrayShape(['success' => "string[]", 'staff_member_id' => "string[]", 'user_id' => "string[]"])]
    public static function getFields(): array
    {
        // field, type, required, placeholder, tip, model for select
        return [
            'success' => ['checkbox', 'option', 'optional', 'Did you manage to contact the person?', 'Check if success. Leave blank if you did not manage to contact the person. Then SAVE'],
            'staff_member_id' => ['input', 'hidden', 'required', 'The ID of the logged in staff', 'Automatic'],
            'user_id' => ['input', 'hidden', 'required', 'The ID of the contacted user', 'Automatic'],
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(StaffMember::class);
    }

    /**
     * A feedback CAN BE associated to a contact attempt.
     * Cos a contact attempt is feedbackable
     * @return MorphOne
     */
    public function feedback(): MorphOne
    {
        return $this->morphOne(Feedback::class, 'feedbackable');
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
}
