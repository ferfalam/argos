<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Observers\SpvDetailObserver;
use App\Scopes\CompanyScope;
use App\Traits\CustomFieldsTrait;
use Illuminate\Notifications\Notifiable;

class SpvDetails extends BaseModel
{
    use Notifiable;
    use CustomFieldsTrait;

    protected $table = 'Spv_details';
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

        static::observe(SpvDetailObserver::class);

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

    public function SvpProjects(){
        return $this->hasMany(Project::class, 'Svp_detail_id');
    }

    public function SpvProjects(){
        return $this->hasMany(Project::class, 'spv_detail_id');
    }
    

}
