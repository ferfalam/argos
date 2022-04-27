<?php

namespace App\Observers;

use App\SupplierDocs;

class SupplierDocsObserver
{

    public function saving(SupplierDocs $SupplierDocs)
    {
        // Cannot put in creating, because saving is fired before creating. And we need company id for check bellow
        if (company()) {
            $SupplierDocs->company_id = company()->id;
        }
    }

}