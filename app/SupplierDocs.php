<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Observers\SupplierDocsObserver;
use App\Scopes\CompanyScope;

class SupplierDocs extends BaseModel
{
    protected $fillable = [];

    protected $guarded = ['id'];
    protected $table = 'supplier_docs';

    protected $appends = ['file_url'];

    protected static function boot()
    {
        parent::boot();

        static::observe(SupplierDocsObserver::class);

        static::addGlobalScope(new CompanyScope);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFileUrlAttribute()
    {
        return asset_url_local_s3('supplier-docs/' . $this->supplier_detail_id . '/' . $this->hashname);
    }
}
