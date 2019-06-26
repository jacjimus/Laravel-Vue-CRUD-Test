<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seasons;
use App\Http\Resources\Seasons AS SeasonsResource;
class SeasonsController extends Controller
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
        $seasons = Seasons::where('status' , 1)->where('deleted_at' , null)->get();
        return SeasonsResource::collection($seasons);

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
            'name' => 'required',
            'start' => 'required',
            'end' => 'required',

        ]);


        $season = ($request->isMethod('put')) ? Seasons::findOrFail($request->input('id')) : new Seasons();
        $season->name = $request->input('name');
        $season->end = $request->input('end');
        $season->start = $request->input('start');
        $season->status = 1;

        if($season->save())
            return new SeasonsResource($season);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Seasons::destroy($id);
        return response()->json(['success'=>"Season deleted successfully.", 'id'=>''.$id]);
    }
}
