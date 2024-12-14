<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * index
     * 
     * @return void
     */
    public function index(){
        $products = Product::latest()->paginate(5);

        return new ProductResource(true, 'List Data Posts', $products);
    }

    /**
     * store
     * 
     * @param mixed $request
     * @return void
     */

    public function store(Request $request){
        // define validation rules
        $validator = Validator::make($request->all(), [
            'nama_product' => 'required',
            'harga_product' => 'required',
            'stok_product' => 'required',
            'image_url' => 'required'
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $product = Product::create([
            'nama_product' => $request->nama_product,
            'harga_product' => $request->harga_product,
            'stok_product' => $request->stok_product,
            'image_url' => $request->image_url,
        ]);

        return new ProductResource(true, 'Data Post Berhasil Ditambahkan!', $product);
    }

    /**
     * show
     * 
     * @param mixed $id
     * @return void
     */
    public function show($id){
        //find post by ID
        $product = Product::find($id);

        return new ProductResource(true, 'Detail Data Post!', $product);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama_product'     => 'required',
            'harga_product'   => 'required',
            'stok_product'     => 'required',
            'image_url'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by ID
        $product = Product::find($id);
        //update post without image
        $product->update([
            'nama_product' => $request->nama_product,
            'harga_product' => $request->harga_product,
            'stok_product' => $request->stok_product,
            'image_url' => $request->image_url,
        ]);

        //return response
        return new ProductResource(true, 'Data Post Berhasil Diubah!', $product);
    }

    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {

        //find post by ID
        $product = Product::find($id);

        //delete post
        $product->delete();

        //return response
        return new ProductResource(true, 'Data Post Berhasil Dihapus!', null);
    }
}
