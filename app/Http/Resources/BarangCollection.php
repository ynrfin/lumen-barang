<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BarangCollection extends ResourceCollection
{
    /* Transform resource to array
     */
    public function toArray($request)
    {
        return $this->collection;
    }
}
?>
