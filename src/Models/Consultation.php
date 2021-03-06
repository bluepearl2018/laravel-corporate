<?php

namespace Eutranet\Corporate\Models;

use Flash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;
use JetBrains\PhpStorm\ArrayShape;
use Session;
use Spatie\TranslationLoader\LanguageLine;
use Eutranet\Corporate\Models\User;
use Eutranet\Corporate\Models\StaffMember;
use Eutranet\Corporate\Models\Agency;
use Eutranet\Corporate\Models\Feedback;

/**
 * The Consultation class is intended to save consultations information and attach feedback
 * A consultation is planned first. Then a feedback can be added afterwards.
 * A consultation is booked on a certain date, at a certain time
 */
class Consultation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "consultations";

    protected $fillable = [
        'user_id',
        'agency_id',
        'consultant_id',
        'staff_member_id',
        'booked_on',
        'booked_at',
        'briefing',
        'feedback_id',
        'modified_by'
    ];

    /**
     * @param $value
     * @return string
     */
    public function getBookedOnAttribute($value): string
    {
        return $this->asDateTime($value)->format('Y-m-d');
    }

    /**
     * @param $value
     * @return string
     */
    public function getBookedAtAttribute($value): string
    {
        return $this->asDateTime($value)->format('H:i');
    }

    /**
     * @return array
     */
    #[ArrayShape(['user_id' => "string[]", 'agency_id' => "string[]", 'consultant_id' => "string[]", 'booked_on' => "string[]", 'booked_at' => "string[]", 'briefing' => "string[]", 'feedback_id' => "string[]", 'staff_member_id' => "string[]"])]
    public static function getFields(): array
    {
        // field, type, required, placeholder, tip, model for select
        return [
            'agency_id' => ['select', 'list', 'required', trans('consultations.Agency'), trans('consultations.Select the agency'), '\Eutranet\Corporate\Models\Agency'],
            'consultant_id' => ['select', 'list', 'required', trans('consultations.Consultant'), trans('consultations.Pick a consultant / staff member from the list'), '\Eutranet\Corporate\Models\StaffMember'],
            'booked_on' => ['dates', 'date', 'required', trans('consultations.Booked on (Date)'), trans('consultations.Please pick the consultation date')],
            'booked_at' => ['dates', 'time', 'required', trans('consultations.Booked at (Time)'), trans('consultations.Please pick the consultation time')],
            'briefing' => ['input', 'textarea', 'required', trans('consultations.Enter feedback'), trans('consultations.Straight to the point. 2 or 3 lines, please...')],
            'feedback_id' => ['input', 'hidden', 'optional', trans('consultations.The feedback id'), trans('consultations.Feedbacks are provided for actions')],
            // 'modified_by' => ['select', 'simple', 'required', 'Staff', 'Select the staff member', '\Eutranet\Corporate\Models\StaffMember'],
        ];
    }

    public static function saveTranslations()
    {
        $lls = array(
            array('group' => 'fields', 'key' => 'agency_id', 'text' => '{"en":"Agency", "pt":"Sucursal / Agencia"}'),
            array('group' => 'fields', 'key' => 'consultant_id', 'text' => '{"en":"Consultant", "pt":"Consulto / Staff"}'),
            array('group' => 'fields', 'key' => 'booked_on', 'text' => '{"en":"Booked on", "pt":"Agendado no dia"}'),
            array('group' => 'fields', 'key' => 'booked_at', 'text' => '{"en":"Booked at", "pt":"Agendado as"}'),
            array('group' => 'fields', 'key' => 'briefing', 'text' => '{"en":"Briefing", "pt":"Briefing"}'),
            array('group' => 'fields', 'key' => 'feedback_id', 'text' => '{"en":"Feedback", "pt":"Feedback"}'),
        );

	    if (\Schema::hasTable('language_lines')) {
		    foreach ($lls as $ll) {
			    if(! LanguageLine::where([
				    'group' => $ll['group'],
				    'key' => $ll['key']
			    ])->get()->first())
			    {
				    LanguageLine::create([
					    'group' => $ll['group'],
					    'key' => $ll['key'],
					    'text' => json_decode($ll['text'], true)
				    ]);
			    };
		    }
	    }
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function consultant(): BelongsTo
    {
        return $this->belongsTo(StaffMember::class, 'consultant_id');
    }

    /**
     * @return BelongsTo
     */
	public function staffMember(): BelongsTo
    {
        return $this->belongsTo(StaffMember::class, 'staff_member_id');
    }

    /**
     * Get the agency where the consultation should be planned
     * Agency is not mandatory. Should be assigned if the agency for the consultation
     * is not the agency where the staff member belongs to.
     *
     * @return BelongsTo
     */
    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class, 'agency_id');
    }


    /**
     * @param $query
     * @param $filter
     */
    public function scopefilterSection($query, $filter)
    {
        switch ($filter) {
            case 'overdue':
                $query->whereRaw('CURDATE() > DATE(`booked_on`)');
                break;
            case 'today':
                $query->whereRaw('CURDATE() = DATE(`booked_on`)');
                break;
            case 'tomorrow':
                $query->whereRaw('CURDATE() = DATE(DATE_ADD(`booked_on`, INTERVAL -1 DAY))');
                break;
            case 'coming':
                $query->whereRaw('CURDATE() < DATE(DATE_ADD(`booked_on`, INTERVAL -1 DAY))');
                break;
        }
    }

    /**
     * Get the feedback associated to the consultation.
     * A single feedback is allowed for the consultation.
     *
     * @return MorphOne
     */
    public function feedback(): MorphOne
    {
        return $this->morphOne(Feedback::class, 'feedbackable');
    }

    /**
     * @return BelongsTo
     */
    public function modifiedBy(): BelongsTo
    {
        return $this->belongsTo(StaffMember::class, 'staff_member_id');
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

	public static function booted()
	{
		static::saveTranslations();
	}
}
