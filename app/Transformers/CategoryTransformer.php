<?php 

namespace App\Transformers;

use App\Category;
use League\Fractal\TransformerAbstract;


class CategoryTransformer extends TransformerAbstract
{
	public function transform(Category $category)
	{
		return [
			'type' => 'category',
            'id' => (string)$category->id,
            'atttributes' => [
                'name' => $category->name,
                'created_at' => $category->created_at,
                'updated_at' => $category->updated_at,
                // "related" => $category->barangs
            ],
            "links" => [
                "self" => route('barang.one', ['id' => $category->id])
            ]
		];
	}
}

 ?>