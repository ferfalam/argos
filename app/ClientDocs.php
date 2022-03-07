<?php

namespace App;

use App\Observers\ClientDocsObserver;
use App\Scopes\CompanyScope;

class ClientDocs extends BaseModel
{
    // Don't forget to fill this array
    protected $fillable = [];

    protected $guarded = ['id'];
    protected $table = 'client_docs';

    protected $appends = ['file_url'];

    protected static function boot()
    {
        parent::boot();

        static::observe(ClientDocsObserver::class);

        static::addGlobalScope(new CompanyScope);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFileUrlAttribute()
    {
        return asset_url_local_s3('client-docs/' . $this->client_detail_id . '/' . $this->hashname);
    }

}
