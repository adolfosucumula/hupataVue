<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobsRequest;
use App\Models\Jobs;
use Illuminate\Http\Request;

class JobsCtl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Jobs::orderBy('created_at','ASC')->limit('15')->get());
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
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json(Jobs::find($id));
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

    public function search(JobsRequest $request){
        $rs = Jobs::where('title','like','%'.$request->search.'%')
            ->orWhere('detail','like','%'.$request->search.'%')
            ->orWhere('id', $request->search)
            ->get();
        return response()->json($rs);
    }

    public function viewJob(JobsRequest $request){

        $rs = Jobs::where('title','like','%'.$request->title.'%')
        ->orWhere('detail','like','%'.$request->title.'%')
        ->orWhere('id', $request->id)
        ->get();
        return response()->json($rs);
    }
}
