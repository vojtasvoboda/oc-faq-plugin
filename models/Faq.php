<?php namespace VojtaSvoboda\Faq\Models;

use Model;
use October\Rain\Database\Traits\SoftDelete as SoftDeleteTrait;
use October\Rain\Database\Traits\Sortable as SortableTrait;
use October\Rain\Database\Traits\Validation as ValidationTrait;

class Faq extends Model
{
    use SoftDeleteTrait;

    use SortableTrait;

    use ValidationTrait;

	public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    public $table = 'vojtasvoboda_faq_faqs';

    public $rules = [
        'name' => 'required|max:255',
        'text' => 'required|max:1000',
        'enabled' => 'boolean',
    ];

	public $translatable = ['name', 'text'];

    public $attributeNames = [
        'name' => 'Otázka',
        'text' => 'Odpověď',
    ];

    public $customMessages = [
        'required' => 'Pole :attribute je povinné.',
    ];

    public $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function scopeIsEnabled($query)
    {
        return $query->where('enabled', true);
    }
}
