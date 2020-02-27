<?php

namespace App\Http\Controllers;
use App\Models\Products;
use App\Http\Resources\ProductsResource;
use App\Http\Requests\ProductRequest;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
         * find only active price and none trashed
         */
        $products = Products::where('deleted_at' , null)->get();
        return ProductsResource::collection($products);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

    	$product = new Products();
    	$product->fill($request->all());

        if($product->save())
            return new ProductsResource($product);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Products::find($id)->delete();
        return response()->json(['success'=>"Room type deleted successfully.", 'id'=>''.$id]);
    }
}
