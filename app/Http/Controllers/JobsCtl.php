<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobsRequest;
use App\Models\Jobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function store(JobsRequest $request)
    {
        try {
            $rs = Jobs::create([
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'detail' => $request->detail,
                'requirements' => $request->requirements,
                'tax_per_hour' => $request->tax_per_hour,
                'total_tax' => $request->total_tax,
                'time_required' => $request->time_required,
                'preferences' => $request->prferences,
                'currency' => $request->currency,
                'created_at'=> date('Y-m-d H:s:i'),
                'updated_at'=> date('Y-m-d H:s:i')
            ]);
            return response()->json(['save'=>true,'inserted'=> $rs->id,],200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['save'=>false,'errors'=> $th,'error'=> $th->getMessage()],422);
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
            return response()->json(Jobs::find($id));
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['errors'=>$th, 'error' => $th->getMessage()]);
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
            return response()->json(Jobs::find($id));
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['errors'=>$th, 'error' => $th->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JobsRequest $request, $id)
    {
        try {
            $rs = Jobs::where('id',$id)
            ->update([
                'title' => $request->title,
                'detail' => $request->detail,
                'requirements' => $request->requirements,
                'tax_per_hour' => $request->tax_per_hour,
                'total_tax' => $request->total_tax,
                'time_required' => $request->time_required,
                'preferences' => $request->prferences,
                'currency' => $request->currency,
                'updated_at'=> date('Y-m-d H:s:i')
            ]);
            return response()->json(['update'=>true,'inserted'=> $rs->id,],200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['update'=>false,'error'=> $th,'error_message'=> $th->getMessage()],422);
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
            Jobs::deleted($id);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th->getMessage());
        }
    }

    public function search(Request $request){
        try {
            $rs = Jobs::where('title','like','%'.$request->search.'%')
            ->orWhere('detail','like','%'.$request->search.'%')
            ->orWhere('id', $request->search)
            ->get();
            return response()->json($rs);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['errors'=> $th, 'error'=> $th->getMessage()]);
        }
    }

    public function viewJob(Request $request){

        $rs = Jobs::where('title','like','%'.$request->title.'%')
        ->orWhere('detail','like','%'.$request->title.'%')
        ->orWhere('id', $request->id)
        ->get();
        return response()->json($rs);
    }

    public function allPostedJobs(Request $request){
        try {
            $rs = Jobs::where('user_id', $request->user)
            //->orWhere('detail','like','%'.$request->title.'%')
            ->get();
            return response()->json($rs);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['errors'=> $th, 'error'=> $th->getMessage()]);
        }
    }
}
