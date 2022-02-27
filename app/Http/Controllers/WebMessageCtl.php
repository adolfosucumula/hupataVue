<?php

namespace App\Http\Controllers;

use App\Models\WebMessage;
use Illuminate\Http\Request;

class WebMessageCtl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rs = WebMessage::all();
        return response()->json($rs);
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
        try {
            $rs = WebMessage::create([
                'name' => $request->name,
                'email' => $request->email,
                'cellphone' => $request->cellphone,
                'subject' => $request->subject,
                'message' => $request->message
            ]);
            return response()->json($rs);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $rs = WebMessage::find($id);
            return response()->json($rs);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $rs = WebMessage::find($id);
            return response()->json($rs);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th);
        }
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
        try {
            $rs = WebMessage::find($id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'cellphone' => $request->cellphone,
                'subject' => $request->subject,
                'message' => $request->message
            ]);
            return response()->json($rs);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            return WebMessage::destroy($id);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th);
        }
    }

    public function search(Request $request){
        try {
            $rs = WebMessage::where('name', 'like','%'.$request->search.'%')
            ->orWhere('email', $request->search)->get();
            return response()->json($rs);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th);
        }
    }

}
