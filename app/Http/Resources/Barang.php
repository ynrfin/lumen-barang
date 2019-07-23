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
            'type' => 'barang',
            'id' => (string)$this->id,
            'atttributes' => [
                'kode' => $this->kode,
                'nama' => $this->nama,
                'deskripsi' => $this->deskripsi,
                'harga' => $this->harga,
                'stok' => $this->stok,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ]
        ];
    }
}
?>
