<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobBidsRequest;
use App\Models\CustomerBids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CustomerBidsCtl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $rs = CustomerBids::orderBy('id', 'desc')->get();
            return response()->json($rs);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
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
    public function store(JobBidsRequest $request)
    {
        $pathToFile = '';

        try {

            if($request->presentationfile !=''){

                $pathToFile = $request->file('presentationfile')->store('docs', 'public');
            }

            $rs = CustomerBids::create([
                'user_id' => Auth::user()->id,
                'job_id' => $request->jobID,
                'presentation_letter' => $request->presentationletter,
                'presentation_file' => $pathToFile,
                'tax_per_hour' => $request->tax_per_hour,
                'app_tax' => $request->app_tax,
                'tax_to_receive' => $request->tax_to_receive,
                'days' => $request->days,
                'created_at'=> date('Y-m-d H:s:i'),
                'updated_at'=> date('Y-m-d H:s:i')
            ]);
            if($rs->id){
                return response()->json(['save'=>true,'inserted'=> $rs->id,'file'=>$pathToFile],200);
            }else{
                Storage::disk('public')->delete($pathToFile);
                return response()->json(['save'=>false,'inserted'=> 0,],422);
            }
        } catch (\Throwable $th) {
            Storage::disk('public')->delete($pathToFile);
            return response()->json(['save'=>false,'errors'=> $th,'error'=> $th->getMessage()],422);
        }
    }

    public function getJobBids($jobID){
        try {
            $rs = CustomerBids::join('users','customer_bids.user_id', '=', 'users.id')
            ->select('users.*','customer_bids.*')
            ->orderBy('customer_bids.id','desc')->where('customer_bids.job_id', $jobID)->get();
            return response()->json($rs);
        } catch (\Throwable $th) {
            return response()->json(['errors'=> $th,'error'=> $th->getMessage()],422);
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
}
