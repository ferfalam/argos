<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Observers\SupplierDetailsObserver;
use App\Scopes\CompanyScope;
use App\Traits\CustomFieldsTrait;
use Illuminate\Notifications\Notifiable;

class SupplierDetails extends Model
{
    use Notifiable;
    use CustomFieldsTrait;

    protected $table = 'supplier_details';
    protected $fillable = [
        'company_name',
        'name',
        'email',
        'image',
        'mobile',
        'user_id',
        'address',
        'city',
        'tel',
        'fax',
    ];

    protected $default = [
        'id',
        'company_name',
        'address',
    ];


    protected $appends = ['image_url'];

    protected static function boot()
    {
        parent::boot();

        static::observe(SupplierDetailsObserver::class);

        static::addGlobalScope(new CompanyScope);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withoutGlobalScopes(['active']);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id')->withoutGlobalScopes(['active', CompanyScope::class]);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function clientCategory()
    {
        return $this->belongsTo(ClientCategory::class, 'category_id');
    }

    public function clientSubcategory()
    {
        return $this->belongsTo(ClientSubCategory::class, 'sub_category_id');
    }

    public function getImageUrlAttribute()
    {
        return ($this->image) ? asset_url('avatar/' . $this->image) : asset('img/default-profile-3.png');
    }




}
