<?php

namespace Eutranet\Corporate\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;
use JetBrains\PhpStorm\ArrayShape;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * Feeedback is to save feedbacks
 * And attach them to feedbackles (contact attempt, for instance)
 *
 */
class Feedback extends Model implements HasMedia
{
    use InteractsWithMedia;
    use SoftDeletes;

    protected $table = "feedbacks";
    protected $fillable = [
        'body',
        'created_by',
        'modified_by',
        'user_id',
        'feedbackable_type',
        'feedbackable_id'
    ];

    #[ArrayShape(['body' => "string[]", 'staff_member_id' => "string[]", 'user_id' => "string[]", 'modified_by' => "string[]", 'created_by' => "string[]"])]
    public static function getFields(): array
    {
        // field, type, required, placeholder, tip, model for select
        return [
            'body' => ['input', 'textarea', 'required', 'Feedback content', 'It is a memo. Not too long, please!'],
            'staff_member_id' => ['input', 'hidden', 'optional', 'Staff id', 'Should be automatic'],
            'user_id' => ['input', 'hidden', 'optional', 'The feedback for this user... ', 'Automatic'],
        ];
    }


    /**
     * Get the parent feedbackabkle type
     */
    public function feedbackable(): MorphTo
    {
        return $this->morphTo('feedbackable');
    }

    /**
     * @return BelongsTo
     */
    public function staff(): BelongsTo
    {
        return $this->belongsTo(StaffMember::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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
