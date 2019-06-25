<?php

namespace App\Http\Controllers;

use App\Http\Resources\Hotel;
use Illuminate\Http\Request;
use App\Models\Hotels;
use App\Http\Resources\Hotel as HotelResource;
class HotelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all active hotels and non-trashed

        $hotels = Hotels::where('status' , 1)->where('deleted_at' , null)->get();

        //return collection of hotels as a resource

        return HotelResource::collection($hotels);
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
    public function store(Request $request)
    {



         $request->validate([
            'name' => 'bail|required',
            'address' => 'required',
            'country' => 'required',
            'city' => 'required',
            'phone_number' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'email' => 'required',

        ]);


        if($request->isMethod('put') ) :
         $hotel = Hotels::findOrFail($request->input('hotel_id'));

        $hotel->name = $request->input('name');
        $hotel->address = $request->input('address');
        $hotel->city = $request->input('city');
        $hotel->state = $request->input('state');
        $hotel->country = $request->input('country');
        $hotel->zip = $request->input('zip');
        $hotel->phone_number = $request->input('phone_number');
        $hotel->email = $request->input('email');
            if ($request->hasFile('image')) {
                $file = array('image' =>  $request->file('image'));

                $request->file('image')->move(public_path() . '/images/',
                    $file);
            }
        if($hotel->save())
            return new HotelResource($hotel);

        endif;
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



}
