<?php

namespace App\Observers;

use App\SpvDocs;

class SpvDocsObserver
{

    public function saving(SpvDocs $spvDocs)
    {
        // Cannot put in creating, because saving is fired before creating. And we need company id for check bellow
        if (company()) {
            $spvDocs->company_id = company()->id;
        }
    }

}
