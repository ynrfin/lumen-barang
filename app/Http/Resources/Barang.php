<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Barang extends JsonResource
{
    /* Transform resource to array
     */
    public function toArray($request)
    {
        return [
            //'id' => $this->id,
            //'kode' => $this->kode,
            'nama' => $this->nama,
            'deskripsi' => $this->deskripsi,
            'harga' => $this->harga,
            'stok' => $this->stok,
            'created_at' => $this->created_at
        ];
    }
}
?>
