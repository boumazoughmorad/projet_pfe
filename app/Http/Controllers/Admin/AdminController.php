<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    function create(Request $request){
          //Validate Inputs
        //   $request->validate([
        //       'name'=>'required',
        //       'email'=>'required|email|unique:admins,email',
        //       'password'=>'required|min:5|max:30',
        //       'cpassword'=>'required|min:5|max:30|same:password',
        //       'image' => 'required|mimes:jpg,png|max:2048',
        //   ]);
          if ($file = $request->file('image_path')) {
            // $path = $file->store('public/profile/admin_img');
            if($request->hasFile('image_path'))
            $path=Storage::disk('public')->putFile('profile',$file);
        }
        

          $admin = new Admin([
          'name' => $request->name,
           'email' => $request->email,
           'password' => Hash::make($request->password)]);
           $admin->image_path= $path;
          $save = $admin->save();

          if( $save ){
            
              return response()->json(['message'=>'regestered'],200);
          }else{
           
            return response()->json(['message'=>'noooooooooooooooo'],404);
              
          }
    }
    
  
    public function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required|min:5|max:30'
         ]);
        $admin= Admin::whereEmail($request ->email)->first();
        if (isset($admin->id)) {
            if(Hash::check($request->password,$admin->password)){
                $token=$admin->createToken('token')->plainTextToken; 
                $id=$admin->id;  
            //     return response()->json(['message'=>'Successfully',
            //     'token'=>$token
            // ],404); 
            return response()->json([
                        'tokenadmin' => $token,
                        'idAdmin'=>$id,
                    ]);
            
            }else{
                return response()->json(['message'=>'passwordincorect'],404);
            }
            
        }else{
            return response()->json(['message'=>'adminintrovable'],404);
        }}
    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'email|required',
    //         'password' => 'required'
    //     ]);
    
    //     $credentials = request(['email', 'password']);
    //     if (!auth()->attempt($credentials)) {
    //         return response()->json([
    //             'message' => 'The given data was invalid.',
    //             'errors' => [
    //                 'password' => [
    //                     'Invalid credentials'
    //                 ],
    //             ]
    //         ], 422);
    //     }
    
    //     $admin = Admin::where('email', $request->email)->first();
    //     $authToken = $admin->createToken('token')->plainTextToken;
    //     $id=$admin->id;
    //     return response()->json([
    //         'tokenadmin' => $authToken,
    //         'idAdmin'=>$id,
    //     ]);
    // }


    
    public function getadmin(){
        return response()->json(Admin::all(),200);
    }
    public function getadminById($id){
        $product=Admin::find($id);
        if(is_null($product)){
            return response()->json(['message'=>'adminintrovable'],404);
        }
        return response()->json(Admin::find($id),200);
    }
    public function updateAdmin(Request $request,$id){
        $admin=Admin::find($id);
        if(is_null($admin)){
            return response()->json(['message'=>'Admin introvable'],404);
        }
        $admin->update($request->all());
        return response($admin,200);

    }
    public function deleteAdmin(Request $request,$id){
        $admin=Admin::find($id);
        if(is_null($admin)){
            return response()->json(['message'=>'Admin introvable'],404);
        }
        $admin->delete();
        return response()->json(['message'=>'deleted'],405);
        
    }



}

