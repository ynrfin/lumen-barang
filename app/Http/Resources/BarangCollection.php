<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BarangCollection extends ResourceCollection
{
    //public static $wrap = "results";
    /* Transform resource to array
     */
    public function toArray($request)
    {
        return [
            $this->collection
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
