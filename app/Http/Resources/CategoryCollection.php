<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
{
    /* Transform resource to array
     */
    public function toArray($request)
    {
        return [
            'items' => $this->collection
        ];
    }
}
?>
