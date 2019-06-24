<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use Illuminate\Http\Request;
use App\Http\Resources\Rooms AS RoomResource;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Rooms::get();
        return RoomResource::collection($rooms);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate room fields
        $request->validate([
            'room_name' => 'required',
            'hotel_id' => 'required',
            'room_type_id' => 'required',
            'room_capacity_id' => 'required',
            'room_image' => 'required',
           ]);


       $room = ($request->isMethod('put')) ? Rooms::findOrFail($request->input('id')) : new Rooms;
        $room->room_name = $request->input('room_name');
        $room->hotel_id = $request->input('hotel_id');
        $room->room_type_id = $request->input('room_type_id');
        $room->room_capacity_id = $request->input('room_capacity_id');

            if ($request->hasFile('room_image')) {
                $image = $request->file('room_image');

                $image->move(public_path() . '/images/rooms/',
                    $image->getClientOriginalName());
                $room->room_image = $image->getClientOriginalName();
            }
            if($room->save())
                return new RoomResource($room);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
