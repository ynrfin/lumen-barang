<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Http\Resources\Barang as BarangResource;
use App\Http\Resources\BarangCollection as BarangCollection;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function showAll()
    {
        return new BarangCollection(Barang::paginate());
    }

    public function showOne($id)
    {
        return new BarangResource(Barang::findOrFail($id));
    }

    public function patch($id, Request $request)
    {
        $this->validate($request, [
            'kode' => 'string',
            'stok' => 'integer|min:0',
            'harga' => 'integer|min:0',
            'nama' => 'string',
            'deskripsi' => 'string'
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($request->all());
        $barang->save();

        return new BarangResource($barang);
    }

    public function put($id, Request $request)
    {
        $this->validate($request, [
            'kode' => 'required|string',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|integer|min:0',
            'nama' => 'required|string',
            'deskripsi' => 'required|string'
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($request->all());
        $barang->save();

        return new BarangResource($barang);
    }

    public function delete($id)
    {
        Barang::find($id)->delete();
        return response()->json('{}');
    }
}

?>
