<?php

namespace Modules\Zoom\Entities;

use App\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;
use Modules\Zoom\Observers\ZoomCategoryObserver;

class Category extends Model
{
    
    protected $table = 'zoom_categories';
    protected $fillable = [];

    protected static function boot()
    {
        parent::boot();

        static::observe(ZoomCategoryObserver::class);

        static::addGlobalScope(new CompanyScope);
    }
}
