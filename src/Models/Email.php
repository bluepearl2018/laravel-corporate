<?php

namespace Eutranet\Corporate\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;
use JetBrains\PhpStorm\ArrayShape;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

/**
 * Emails are not messages.
 * Emails are for the WEBSITE, FRONTEND PART, FOR THE AUTHENTICATED USERS
 * Messages are for the BACKOFFICE and AUTHED PART
 *
 */
class Email extends Model implements HasMedia
{
    use InteractsWithMedia; // Has Medias, PDF, images...
    use HasRoles;
    use SoftDeletes;

    protected $table = "emails";

    protected $fillable = [
        'from',
        'to',
        'subject',
        'message_body',
        'staff_member_id',
        'user_id',
        'file_path'
    ];

    #[ArrayShape(['subject' => "string[]", 'message_body' => "string[]", 'file_path' => "string[]"])]
    public static function getFields(): array
    {
        // field, type, required, placeholder, tip, model for select
        return [
            'subject' => ['input', 'text', 'required', trans('emails.Subject'), trans('emails.Enter the email subject')],
            'message_body' => ['input', 'textarea', 'required', trans('emails.Message'), trans('emails.Enter the message body')],
            'file_path' => ['input', 'file', 'optional', trans('emails.ZIP file, with documents'), trans('emails.Attach a single document or a zip')]
        ];
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
