<?php

namespace Modules\Zoom\Observers;

use Modules\Zoom\Entities\Category;

class ZoomCategoryObserver
{

    public function saving(Category $category)
    {
        // Cannot put in creating, because saving is fired before creating. And we need company id for check bellow
        if (company()) {
            $category->company_id = company()->id;
        }
    }

}
