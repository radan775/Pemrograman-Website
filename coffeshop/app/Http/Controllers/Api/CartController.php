<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * index
     * 
     * @return void
     */
    public function index(){
        $carts = Cart::latest()->paginate(5);

        return new CartResource(true, 'List Data Posts', $carts);
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

        $cart = Cart::create([
            'nama_product' => $request->nama_product,
            'harga_product' => $request->harga_product,
            'stok_product' => $request->stok_product,
            'image_url' => $request->image_url,
        ]);

        return new CartResource(true, 'Data Post Berhasil Ditambahkan!', $cart);
    }

    /**
     * show
     * 
     * @param mixed $id
     * @return void
     */
    public function show($id){
        //find post by ID
        $cart = Cart::find($id);

        return new CartResource(true, 'Detail Data Post!', $cart);
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
        $cart = Cart::find($id);
        //update post without image
        $cart->update([
            'nama_product' => $request->nama_product,
            'harga_product' => $request->harga_product,
            'stok_product' => $request->stok_product,
            'image_url' => $request->image_url,
        ]);

        //return response
        return new CartResource(true, 'Data Post Berhasil Diubah!', $cart);
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
        $cart = Cart::find($id);

        //delete post
        $cart->delete();

        //return response
        return new CartResource(true, 'Data Post Berhasil Dihapus!', null);
    }
}
