<?php

namespace App\Http\Controllers;
use App\Barang;

class BarangController extends Controller
{
    public function showAll()
    {
        return response()->json(Barang::all());
    }

    public function showOne($id)
    {
        return response()->json(Barang::findOrFail($id));
    }

    public function update($id, Request $request)
    {
        $barang = Barang::findOrFail($id);
        $barang->load($request->all());
        $barang->save();

        return response()->json('show update');
    }

    public function delete($id)
    {
        Barang::find($id)->delete();
        return response()->json('deleted');
    }

    public function increaseStock($id, Request $request)
    {
        $barang = Barang::findOrFail($id);
        // get delete stok
        // $barang->stok = 

        return response()->json('show increaseStock');
    }

    public function decreaseStock($id, Request $request)
    {
        $barang = Barang::find($id);
        return response()->json('show decreaseStock');
    }
}

?>
