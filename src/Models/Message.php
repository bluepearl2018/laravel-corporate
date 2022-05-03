<?php

namespace Eutranet\Corporate\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;
use JetBrains\PhpStorm\ArrayShape;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * Emails are not messages.
 * Emails are for the WEBSITE, FRONTEND PART
 * Messages are for the BACKOFFICE and AUTHED PART
 *
 */
class Message extends Model implements HasMedia
{
    use InteractsWithMedia;
    use SoftDeletes;
    use HasFactory;

    protected $table = "messages";

    protected $fillable = [
        'to',
        'from',
        'subject',
        'message_body',
        'file_path',
        'user_id',
        'staff_member_id'
    ];

    #[ArrayShape(['subject' => "string[]", 'message_body' => "string[]", 'file_path' => "string[]"])]
    public static function getFields(): array
    {
        // field, type, required, placeholder, tip, model for select
        return [
            'subject' => ['input', 'text', 'required', 'Subject', 'Enter the email subject'],
            'message_body' => ['input', 'textarea', 'required', 'Message', 'Enter the message body'],
            'file_path' => ['input', 'file', 'optional', 'ZIP file, with documents', 'Attach a single document or a zip']
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('attachments');
    }

    /**
     * Returns the message user wno created the email. Can be null
     * @return BelongsTo
     *
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns the message staff member wno created the email. Can be null
     * @return BelongsTo
     *
     */
    public function staffMember(): BelongsTo
    {
        return $this->belongsTo(StaffMember::class);
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
