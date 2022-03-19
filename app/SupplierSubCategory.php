<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierSubCategory extends Model
{

    public function supplier_category()
    {
        return $this->belongsTo(SupplierCategory::class, 'category_id');
    }
}
