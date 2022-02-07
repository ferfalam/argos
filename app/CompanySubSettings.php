<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanySubSettings extends Model
{
    protected $fillable = [
        'description',
        'legal_form',
        'mobile'
    ];

    /**
     * Get the company that owns the CompanySubSettings
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the language associated with the CompanySubSettings
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function language()
    {
        return $this->hasOne(LanguageSetting::class);
    }
}
