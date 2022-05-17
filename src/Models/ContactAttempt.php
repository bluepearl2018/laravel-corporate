<?php

namespace Eutranet\Corporate\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;
use JetBrains\PhpStorm\ArrayShape;
use Spatie\TranslationLoader\LanguageLine;
use Schema;

/**
 * Contact Attempt to describe and save contact attemps from sales
 * This belongs to Contacts folder.
 */
class ContactAttempt extends Model
{
    use SoftDeletes;

    protected $table = "contact_attempts";
    protected $fillable = ['user_id', 'staff_member_id', 'success'];
	protected $casts = ['success' => 'boolean'];

    #[ArrayShape(['success' => "string[]", 'staff_member_id' => "string[]", 'user_id' => "string[]"])]
    public static function getFields(): array
    {
        // field, type, required, placeholder, tip, model for select
        return [
            'success' => ['checkbox', 'option', 'optional', trans('contact-attempts.Did you manage to contact the person?'), trans('contact-attempts.Check if you succeeded. Leave blank if you did not manage to contact the person. Then SAVE.')],
            'staff_member_id' => ['input', 'hidden', 'required', trans('contact-attempts.The ID of the logged in staff member'), trans('contact-attempts.Enter the staff member ID')],
            'user_id' => ['input', 'hidden', 'required', trans('contact-attempts.The ID of the contacted user'), trans('contact-attempts.Enter user id')],
        ];
    }

	public static function saveTranslations()
	{
		$lls = array(
			array('group' => 'fields', 'key' => 'success', 'text' => '{"en":"Success", "pt":"Successo"}'),
			array('group' => 'fields', 'key' => 'staff_member_id', 'text' => '{"en":"Staff Member ID", "pt":"ID do membro da equipa"}'),
			array('group' => 'fields', 'key' => 'user_id', 'text' => '{"en":"User ID", "pt":"ID do utilizador"}'),

			array('group' => 'contact-attempts', 'key' => 'Did you manage to contact the person?', 'text' => '{"en":"Did you manage to contact the person?", "pt":"Conseguiu contatar a pessoa?"}'),
			array('group' => 'contact-attempts', 'key' => 'The ID of the logged in staff member', 'text' => '{"en":"The ID of the logged in staff member", "pt":"O ID do membro da equipa ligado."}'),
			array('group' => 'contact-attempts', 'key' => 'The ID of the contacted user', 'text' => '{"en":"The ID of the contacted user", "pt":"O ID do utilizador contatado"}'),
			array('group' => 'contact-attempts', 'key' => 'Check if you succeeded. Leave blank if you did not manage to contact the person. Then SAVE.', 'text' => '{"en":"Check if you succeeded. Leave blank if you did not manage to contact the person. Then SAVE.", "pt":"Verifique se foi bem sucedido. Deixe em branco se não tiver conseguido contactar a pessoa. Depois SAVE."}'),
			array('group' => 'contact-attempts', 'key' => 'Enter the staff member ID', 'text' => '{"en":"Enter the staff member ID", "pt":"Entre o ID do membro da equipa."}'),
			array('group' => 'contact-attempts', 'key' => 'Enter user id', 'text' => '{"en":"Enter user id", "pt":"Entre o ID do utilizador"}'),
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

	/**
	 * @return BelongsTo
	 */
	public function staffMember(): BelongsTo
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

	public static function boot()
	{
		parent::boot();
	}

	public static function booted()
	{
		static::saveTranslations();
	}
}