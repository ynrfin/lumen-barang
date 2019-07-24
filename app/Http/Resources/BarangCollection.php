<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BarangCollection extends ResourceCollection
{
    /* Transform resource to array
     */
    public function toArray($request)
    {
        return [
            'link' =>route('barang.all'),
            'data' => $this->collection
            //'data' => $this->collection->transform(function($barang){
            //    return [
            //        'type' => 'barang',
            //        'id' => (string)$barang->id,
            //        'atttributes' => [
            //            'kode' => $barang->kode,
            //            'nama' => $barang->nama,
            //            'deskripsi' => $barang->deskripsi,
            //            'harga' => $barang->harga,
            //            'stok' => $barang->stok,
            //            'created_at' => $barang->created_at,
            //            'updated_at' => $barang->updated_at
            //        ]
            //    ];
            //})
        ];
    }
}
?>
