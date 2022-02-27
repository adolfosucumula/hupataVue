<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginCtl extends Controller
{

    public function index()
    {
        $rs = User::all();
        return response()->json($rs);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        try {
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                return response()->json(
                    ['logged'=> Auth::check(),
                    'user'=> Auth::user()
                    ]);
            }
            return response()->json(['logged'=>Auth::check()]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th);
        }
    }

    public function login(Request $request)
    {
        try {
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                return response()->json(
                    ['logged'=> Auth::check(),
                    'user'=> Auth::user()
                    ]);
            }
            return response()->json(['logged'=>Auth::check()]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th);
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
