<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuppliersResource;
use App\Http\Requests\SupplierRequest;
use App\Models\Suppliers;
class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all active hotels and non-trashed

        $suppliers = Suppliers::where('deleted_at' , null)->orderby('name' , 'DESC')->get();

        //return collection of hotels as a resource

        return SuppliersResource::collection($suppliers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierRequest $request)
    {
    	$supplier = new Suppliers();
    	$supplier->fill($request->all());
        if($supplier->save())
            return new SuppliersResource($supplier);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get a single hotel

        $hotel = Hotels::findOrFail($id);
            // return single hotel as a resource
        return new HotelResource ($hotel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

	public function destroy( $id)
	{

		Suppliers::find($id)->delete();
		return response()->json(['success'=>"Supplier deleted successfully.",]);
	}



}
