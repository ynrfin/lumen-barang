<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Resources\CategoryCollection as CategoryCollection;
use Illuminate\Http\Request;
use App\Exceptions\ResourceNotFoundException;
use Spatie\Fractalistic\Fractal;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use App\Transformers\CategoryTransformer;

class CategoryController extends Controller
{
    public function showAll()
    {
        // return new CategoryCollection(Category::paginate());
        $barang = Category::all();

        return Fractal::create()
            ->collection($barang)
            ->transformWith(new CategoryTransformer())
            ->paginateWith(new IlluminatePaginatorAdapter(Category::paginate()))
            ->toArray();
    }

    public function showOne($id)
    {
        $barang = Category::findOrFail($id);
        if(null == $barang){
            throw new ResourceNotFoundException();
        }
        return fractal($barang)->transformWith(new CategoryTransformer())->toArray();
    }

//    public function create(Request $request)
//    {
//        $validated = $this->validate($request, [
//            'kode' => 'required|string',
//            'stok' => 'required|integer|min:0',
//            'harga' => 'required|integer|min:0',
//            'nama' => 'required|string',
//            'deskripsi' => 'required|string'
//        ]);
//
//        $barang = Barang::updateOrCreate($validated);
//        return new BarangResource($barang);
//    }
//
//    public function patch($id, Request $request)
//    {
//        $this->validate($request, [
//            'kode' => 'string',
//            'stok' => 'integer|min:0',
//            'harga' => 'integer|min:0',
//            'nama' => 'string',
//            'deskripsi' => 'string'
//        ]);
//
//        $barang = Barang::findOrFail($id);
//        $barang->update($request->all());
//        $barang->save();
//
//        return new BarangResource($barang);
//    }
//
//    public function put($id, Request $request)
//    {
//        $this->validate($request, [
//            'kode' => 'required|string',
//            'stok' => 'required|integer|min:0',
//            'harga' => 'required|integer|min:0',
//            'nama' => 'required|string',
//            'deskripsi' => 'required|string'
//        ]);
//
//        $barang = Barang::findOrFail($id);
//        $barang->update($request->all());
//        $barang->save();
//
//        return new BarangResource($barang);
//    }
//
//    public function delete($id)
//    {
//        $barang = Barang::findOrFail($id);
//
//        $barang->delete();
//        return response()->json(null, 204);
//    }
}

?>
