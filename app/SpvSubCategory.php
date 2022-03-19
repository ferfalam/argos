<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpvSubCategory extends Model
{
    public function spv_category()
    {
        return $this->belongsTo(SpvCategory::class, 'category_id');
    }
}
