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
        /*
         * Get al the active rooms and non-trashed
         */
        $rooms = Rooms::where('status' , 1)->where('deleted_at' , null)->orderby('created_at' , 'DESC')->get();
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

        //return $request->room_name;
        $request->validate([
            'room_name' => 'required',
            'hotel_id' => 'required',
            'room_type_id' => 'required',
            'room_capacity_id' => 'required',
            //'room_image' => 'required',
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rooms::destroy($id);
        return response()->json(['success'=>"Room Deleted successfully.", 'id'=>''.$id]);
    }
}
