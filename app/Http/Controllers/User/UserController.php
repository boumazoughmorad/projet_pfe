<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function index(){
        return User::all();
    }
    function create(Request $request){
          //Validate Inputs
          $request->validate([
              'name'=>'required',
              'email'=>'required|email|unique:users,email',
              'password'=>'required|min:5|max:30',
              'cpassword'=>'required|min:5|max:30|same:password',
              'address'=>'required|min:5|max:30',
              'country'=>'required|min:5|max:100',
              'city'=>'required|min:5|max:100',
              'image' => 'required|mimes:jpg,png|max:2048',
          ]);
          if ($file = $request->file('image')) {
            $path = $file->store('public/profile/user_img');}

          $user = new User([
          'name' => $request->name,
           'email' => $request->email,
           'address' => $request->address,
           'country' => $request->country,
           'city' => $request->city,
           'password' => Hash::make($request->password)]);
           $user->image_path= $path;
          $save = $user->save();

          if( $save ){
            
              return response()->json(['message'=>'regestered'],200);
          }else{
           
            return response()->json(['message'=>'noooooooooooooooo'],404);
              
          }
    }
   
    
  
    // public function login(Request $request){
    //     // $request->validate([
    //     //     'email'=>'required',
    //     //     'password'=>'required|min:5|max:30'
    //     //  ]);
    //     $user= User::whereEmail($request ->email)->first();
    //     if (isset($user->id)) {
    //         if(Hash::check($request->password,$user->password)){
    //             $token=$user->createToken('token')->plainTextToken;   
    //             return response()->json(['message'=>'Successfully',
    //             'token'=>$token
    //         ],404); 
            
    //         }else{
    //             return response()->json(['message'=>'passwordincorect'],404);
    //         }
            
    //     }else{
    //         return response()->json(['message'=>'userintrovable'],404);
    //     }


    // }
    public function getUser(){
        return response()->json(User::all(),200);
    }
    public function getUserById($id){
        $product=User::find($id);
        if(is_null($product)){
            return response()->json(['message'=>'userintrovable'],404);
        }
        return response()->json(User::find($id),200);
    }
    public function updateUser(Request $request,$id){
        $user=User::find($id);
        if(is_null($user)){
            return response()->json(['message'=>'User introvable'],404);
        }
        $user->update($request->all());
        return response($user,200);

    }
    public function deleteUser(Request $request,$id){
        $user=User::find($id);
        if(is_null($user)){
            return response()->json(['message'=>'User introvable'],404);
        }
        $user->delete();
        return response()->json(['message'=>'deleted'],405);
        
    }


}

