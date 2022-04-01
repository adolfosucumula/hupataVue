<?php

namespace App\Http\Controllers;

use App\Models\SubCategoryKnowledge;
use Illuminate\Http\Request;

class SubcategoryKnowledgeCtl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return response()->json(SubCategoryKnowledge::orderBy('created_at','ASC')->limit('15')->get());
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['errors'=>$th, 'error'=> $th->getMessage()]);
        }
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

    public function search(Request $request){
        try {
            $rs = SubCategoryKnowledge::where('sub_knowledge','like','%'.$request->search.'%')
            ->orWhere('id', $request->search)
            ->get();
            return response()->json($rs);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['errors'=> $th, 'error'=> $th->getMessage()]);
        }
    }

}
