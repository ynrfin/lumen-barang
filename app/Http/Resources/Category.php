<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Barang;

class Category extends JsonResource
{
    /* Transform resource to array
     */
    public function toArray($request)
    {
        return [
            'type' => 'category',
            'id' => (string)$this->id,
            'atttributes' => [
                'name' => $this->name,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                "related" => $this->barangs
            ],
            "links" => [
                "self" => route('barang.one', ['id' => $this->id])
            ]
        ];
    }
}
?>
