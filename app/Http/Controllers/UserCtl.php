<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserCtl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(UserRequest $request)
    {
        $pathToFile = '';
        if($request->photo !=''){
            $pathToFile = $request->file('photo')->store('images', 'public');
        }

        try {
            $rs = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'level' => $request->level,
                'status' => $request->status,
                'photo' => $pathToFile==''? 'images/user.png' : $pathToFile,
                'password' => Hash::make($request->password),
            ]);

            if($rs->id){
                return response()->json(['save'=>true,'inserted'=> $rs->id,],200);
            }else{
                Storage::disk('public')->delete($pathToFile);
                return response()->json(['save'=>false,'inserted'=> 0,],422);
            }
        } catch (\Throwable $th) {
            //throw $th;
            Storage::disk('public')->delete($pathToFile);
            return response()->json(['save'=>false,'error'=> $th,'imagePath'=>$pathToFile,'error_message'=> $th->getMessage(),
            'photo'=>$request->photo],422);
        }
        Storage::disk('public')->delete($pathToFile);
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
