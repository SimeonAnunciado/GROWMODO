<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $data = User::where('role','!=', 1)->get();
        return response()->json([
            'type' => $data != null ? true : false,
            'data' => User::where('role','!=', 1)->orderBy('id','desc')->get()
        ]);
    }
    public function edit(User $user){
        $data = $user;
        return response()->json([
            'type' => $data != null ? true : false,
            'data' => $data
        ]);
    }
    public function update(Request $request, $id ){

        $user = User::find($id);
        $user->name =  $request->name;
        $user->phone =  $request->phone;
        $user->email =  $request->email;
        $user->save();

        return response()->json([
            'type' => $user != null ? true : false,
            'message' => 'success update',
            'data' => null
        ]);

    }

    public function destroy(Request $request){
        $id = $request->id ?? null;
        $user = User::find($id)->delete();
        return response()->json([
            'type' => $user != null ? true : false,
            'message' => 'success delete',
            'data' => $user ?? null
        ]);
    }

    public function unsubscribe(Request $request){
        // unsbscribed
        $id = $request->id ?? null;
        $user = User::find($id);
        // delete token
        $user->tokens()->delete();
        $user->delete();


        return response()->json([
            'type' => $user != null ? true : false,
            'message' => 'success unsubscribed',
            'data' => $user ?? null
        ]);

    }
}
