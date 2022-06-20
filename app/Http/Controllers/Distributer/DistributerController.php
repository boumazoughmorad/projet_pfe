<?php

namespace App\Http\Controllers\Distributer;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Distributer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 

use Illuminate\Support\Facades\Storage;
class DistributerController extends Controller
{
    function create(Request $request){
          //Validate Inputs
        /*  $request->validate([
              'name'=>'required',
              'email'=>'required|email|unique:distributers,email',
              'password'=>'required|min:5|max:30',
              //'cpassword'=>'required|min:5|max:30|same:password',
              'num_tele'=>'required|min:10|max:10',
              'address'=>'required',
              
          ]);*/
          if ($file = $request->file('image_path')) {
            //    $path = $file->store('profile/producer_img');}
            // if ($file = $request->file('logo_path')) {
            //     $path = $file->store('public');
            //     $uplod=public_path('public/img');//public_path('/img')
            //    $path= $file->move($uplod,$file->getClientOriginalName());
                
            // 
            if($request->hasFile('image_path'))
            $path=Storage::disk('public')->putFile('profile',$file);
        }
          
                       
          

         //$file = $request->file('image_path');
         //$uplod="pablic/img";
        //$origimg=$file->getClientOriginalName();
        //$path->$file->move($uplod);

          $distributer = new Distributer([
          'name' => $request->name,
           'email' => $request->email,
           'password' => Hash::make($request->password),
          'num_tele'=>$request->num_tele,
          'address'=>$request->address,
          'description'=>$request->description,
           ]
        );
        $distributer->image_path= $path;
          $save = $distributer->save();

          if( $save ){
            
              return response()->json(['message'=>'regestered'],200);
          }else{
           
            return response()->json(['message'=>'noooooooooooooooo'],404);
              
          }
    }
    
  
    public function login(Request $request){
        // $request->validate([
        //     'email'=>'required',
        //     'password'=>'required|min:5|max:30'
        //  ]);
        $distributer= Distributer::whereEmail($request ->email)->first();
        if (isset($distributer->id)) {
            if(Hash::check($request->password,$distributer->password)){
                $token=$distributer->createToken('auth_token')->plainTextToken;  
                $id=$distributer->id; 
                return response()->json([
                'tokendist'=>$token,
                'idist'=>$id,
            ]); 
            // if(Hash::check($request->password,$distributer->password)){
            //     $token=$distributer->createToken('auth_token')->plainTextToken;   
            //     $id=$distributer->id;
            //     return response()->json([
            //         'tokenfact' => $token,
            //         'idfact'=>$id,
              
            // ]);
           
            
            }else{
                return response()->json(['message'=>'passwordincorect'],404);
            }
            
        }else{
            return response()->json(['message'=>'distributerintrovable'],404);
        }


    }
    public function getdistributer(){
        return response()->json(Distributer::all(),200);
    }
    public function getdistributerById($id){
        $product=Distributer::find($id);
        if(is_null($product)){
            return response()->json(['message'=>'distributerintrovable'],404);
        }
        return response()->json(Distributer::find($id),200);
    }
    public function updateDistributer(Request $request,$id){
        $distributer=Distributer::find($id);
        if(is_null($distributer)){
            return response()->json(['message'=>'Distributer introvable'],404);
        }
        $distributer->update($request->all());
        return response($distributer,200);

    }
    public function deleteDistributer(Request $request,$id){
        $distributer=Distributer::find($id);
        if(is_null($distributer)){
            return response()->json(['message'=>'Distributer introvable'],404);
        }
        $distributer->delete();
        return response()->json(['message'=>'deleted'],405);
        
    }



}

