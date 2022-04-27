<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Observers\SpvDocsObserver;
use App\Scopes\CompanyScope;

class SpvDocs extends BaseModel
{
    protected $fillable = [];

    protected $guarded = ['id'];
    protected $table = 'spv_docs';

    protected $appends = ['file_url'];

    protected static function boot()
    {
        parent::boot();

        static::observe(SpvDocsObserver::class);

        static::addGlobalScope(new CompanyScope);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFileUrlAttribute()
    {
        return asset_url_local_s3('spv-docs/' . $this->spv_detail_id . '/' . $this->hashname);
    }
}
