<?php

namespace App\Http\Controllers;

use App\Http\Resources\Roomtype;
use App\Models\RoomTypes;
use Illuminate\Http\Request;
use App\Http\Resources\Roomtype as RoomtypeResource;

class RoomtypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
         * find only active room types and none trashed
         */
        $room_types = RoomTypes::where('status' , 1)->where('deleted_at' , null)->get();
        return RoomtypeResource::collection($room_types);

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
            'room_type' => 'required',

        ]);


        $room_type = ($request->isMethod('put')) ? Roomtypes::findOrFail($request->input('id')) : new Roomtypes();
        $room_type->room_type = $request->input('room_type');
        $room_type->status = 1;

        if($room_type->save())
            return new RoomtypeResource($room_type);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RoomTypes::destroy($id);
        return response()->json(['success'=>"Room type deleted successfully.", 'id'=>''.$id]);
    }
}
