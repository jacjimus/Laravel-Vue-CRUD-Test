<?php

namespace App\Http\Controllers;
use App\Models\Products;
use App\Http\Resources\ProductsResource;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $request->validate([
            'room_type_id' => 'required',
            'hotel_id' => 'required',
            'season_id' => 'required',
            'cost' => 'required',

        ]);


        $price = ($request->isMethod('put')) ? Prices::findOrFail($request->input('id')) : new Prices();
        $price->room_type_id = $request->input('room_type_id');
        $price->hotel_id = $request->input('hotel_id');
        $price->season_id = $request->input('season_id');
        $price->cost = $request->input('cost');
        $price->status = 1;

        if($price->save())
            return new PriceResource($price);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Prices::destroy($id);
        return response()->json(['success'=>"Room type deleted successfully.", 'id'=>''.$id]);
    }
}
