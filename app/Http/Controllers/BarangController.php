<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Http\Resources\Barang as BarangResource;
use App\Http\Resources\BarangCollection as BarangCollection;
use Illuminate\Http\Request;
use App\Exceptions\ResourceNotFoundException;

class BarangController extends Controller
{
    public function showAll()
    {
        return new BarangCollection(Barang::paginate());
    }

    public function showOne($id)
    {
        $barang = Barang::findOrFail($id);
        if(null == $barang){
            throw new ResourceNotFoundException();
        }
        return new BarangResource($barang);
    }

    public function create(Request $request)
    {
        $validated = $this->validate($request, [
            'kode' => 'required|string',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|integer|min:0',
            'nama' => 'required|string',
            'deskripsi' => 'required|string'
        ]);

        $barang = Barang::updateOrCreate($validated);
        return new BarangResource($barang);
    }

    public function patch($id, Request $request)
    {
        $validated = $this->validate($request, [
            'kode' => 'required_without_all:stok,harga,nama,deskripsi|string',
            'stok' => 'required_without_all:kode,harga,nama,deskripsi|integer|min:0',
            'harga' => 'required_without_all:kode,stok,nama,deskripsi|integer|min:0',
            'nama' => 'required_without_all:kode,stok,harga,deskripsi|string',
            'deskripsi' => 'required_without_all:kode,stok,harga,nama|string'
        ]);
        $barang = Barang::findOrFail($id);

        $barang->update($validated);
        $barang->save();

        return new BarangResource($barang);
    }

    public function put($id, Request $request)
    {
        $validated = $this->validate($request, [
            'kode' => 'required|string',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|integer|min:0',
            'nama' => 'required|string',
            'deskripsi' => 'required|string'
        ]);
        $barang = Barang::findOrFail($id);

        $barang->update($validated);
        $barang->save();

        return new BarangResource($barang);
    }

    public function delete($id)
    {
        $barang = Barang::findOrFail($id);

        $barang->delete();
        return response()->json(null, 204);
    }
}

?>
