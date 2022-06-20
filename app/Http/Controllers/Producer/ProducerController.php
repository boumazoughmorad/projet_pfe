<?php

namespace App\Http\Controllers\Producer;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Producer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
class ProducerController extends Controller
{
    
    function Create(Request $request){
        // return response()->json(['message'=>$require],200);
        $path="";
        //Validate Inputs
          $request->validate([
            //   'name'=>'required',
            //   'email'=>'required|email|unique:producers,email',
            //   'password'=>'required|min:5|max:30',
            //   //'cpassword'=>'required|min:5|max:30|same:password',
            //   'num_tele'=>'required|min:10|max:10',
            //   'num_accont_banque'=>'required|min:5|max:30',
            // //   'logo' => 'required|mimes:jpg,png|max:2048',
           
          ]);
         if ($file = $request->file('logo_path')) {
        //    $path = $file->store('profile/producer_img');}
        // if ($file = $request->file('logo_path')) {
        //     $path = $file->store('public');
        //     $uplod=public_path('public/img');//public_path('/img')
        //    $path= $file->move($uplod,$file->getClientOriginalName());
            
        // 
            // return response()->json(['message'=>'llllllllllllllllll'],200);
            if($request->hasFile('logo_path')){
               // return response()->json(['message'=>'cccccccccc'],200);
                $path=Storage::disk('public')->putFile('profile',$file);
            //    return response()->json(['message'=>$path->getClientOriginalName()],200);
            }
        }
        
        
        // return response()->json(['message'=>'Fin'],200);
          $producer = new Producer([
          'name' => $request->name,
           'email' => $request->email,
           'password' => Hash::make($request->password),
           'num_tele'=>$request->num_tele,
            'num_accont_banque'=>$request->num_accont_banque,
           // 'rating'=>$request->rating,
            'address_stock'=>$request->address_stock,
            'description'=>$request->description,
        ]);
        //    $producer->logo_path= $path;
       $producer->logo_path=$path;
        // return response()->json(['message'=>$producer],200);
          $save = $producer->save();
          

          if( $save ){
            
              return response()->json(['message'=>'regestered'],200);
          }else{
           
            return response()->json(['message'=>'noooooooooooooooo'],404);
              
          }
    }
    
  
    public function Login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required|min:5|max:30'
         ]);
        $producer= Producer::whereEmail($request ->email)->first();
        if (isset($producer->id)) {
            if(Hash::check($request->password,$producer->password)){
                $token=$producer->createToken('auth_token')->plainTextToken;   
                $id=$producer->id;
                return response()->json([
                    'tokenfact' => $token,
                    'idfact'=>$id,
              
            ]); 
            
            }else{
                return response()->json(['message'=>'passwordincorect'],404);
            }
            
        }else{
            return response()->json(['message'=>'producerintrovable'],404);
        }
 

    }
    
    public function getProducer(){
        return response()->json(Producer::all(),200);
    }
    public function getProducerById($id){
        $producer=Producer::find($id);
        if(is_null($producer)){
            return response()->json(['message'=>'producer introvable'],404);
        }
        return response()->json(Producer::find($id),200);
    }
    public function updateProducer(Request $request,$id){
        $producer=Producer::find($id);
        if(is_null($producer)){
            return response()->json(['message'=>'producer introvable'],404);
        }
        $producer->update($request->all());
        return response($producer,200);

    }
    public function deleteProducer(Request $request,$id){
        $producer=Producer::find($id);
        if(is_null($producer)){
            return response()->json(['message'=>'producer introvable'],404);
        }
        $producer->delete();
        return response()->json(['message'=>'deleted'],405);
        
    }


}


