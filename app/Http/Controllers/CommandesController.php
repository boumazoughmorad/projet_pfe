<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\commandess;

class CommandesController extends Controller
{
    function Create(Request $request){
        
            $commandess = new commandess([
          'distrubiteur_id' => $request->distrubiteur_id,
           'panier_id' => $request->panier_id,
        //    'password' => Hash::make($request->password),
           'statu'=>$request->statu,
            'prix_totale_orders'=>$request->prix_totale_orders,
            
            // 'date_orders'=>$request->date_orders,
            // 'date_livraison'=>$request->date_livraison,
            'transport'=>$request->transport,
           
        ]);
        $date_orders=date('Y/m/d');
        $commandess->date_orders=$date_orders;
              $save = $commandess->save();
          

          if( $save ){
            
              return response()->json(['message'=>'regestered'],200);
          }else{
           
            return response()->json(['message'=>'noooooooooooooooo'],404);
              
          }
    }
    
    
    public function dilivry(Request $request,$id){
        $commandess=commandess::find($id);
        if(is_null($commandess)){
            return response()->json(['message'=>'dilivry'],404);
        }
        $date_livraison=date('Y/m/d');
        $commandess->date_livraison=$date_livraison;
        $commandess->statu=1;
        $commandess->update($request->all());
        return response($commandess,200);

    }
    
    public function shipping(Request $request,$id){
        $commandess=commandess::find($id);
        if(is_null($commandess)){
            return response()->json(['message'=>'shipping'],404);
        }
        // $date_livraison=date('Y/m/d');
        // $commandess->date_livraison=$date_livraison;
        $commandess->statu=0;
        $commandess->update($request->all());
        return response($commandess,200);

    }
    
    // public function getCommandess(){
    //     return response()->json(commandess::all(),200);
    //     // $commandess=commandess::get();
    //     // return response()->json(commandess::onlyTrashed()->restore(),200);
    //     // return redirect()->back();
    //     // return view('commandess',compact('commandess'));
    //     // return response()->json(commandess::all(),200);
       
     

    // }
    public function getCommandess(Request $request){
        $commandess=commandess::all();
        return response()->json($commandess,200);
        
 
     }
     public function getAllCommandess(Request $request){
        $commandess=commandess::withTrashed()->get();
        return response()->json($commandess,200);
        
 
     }
    public function getcommandessById($id){
        $commandess=commandess::find($id);
        if(is_null($commandess)){
            return response()->json(['message'=>'commandess introvable'],404);
        }
        return response()->json(commandess::find($id),200);
    }
    public function updatecommandess(Request $request,$id){
        $commandess=commandess::find($id);
        if(is_null($commandess)){
            return response()->json(['message'=>'commandess introvable'],404);
        }
        $commandess->update($request->all());
        return response($commandess,200);

    }
    // public function deletecommandess(Request $request,$id){
    //     $commandess=commandess::find($id);
    //     if(is_null($commandess)){
    //         return response()->json(['message'=>'commandess introvable'],404);
    //     }
    //     $commandess->delete();
    //     return response()->json(['message'=>'deleted'],405);
        
    // }
    public function deletecommandess(Request $request,$id){
        
        $commandess=commandess::find($id);
        if(is_null($commandess)){
            return response()->json(['message'=>'commandess introvable'],404);
        }
        $commandess->delete();
        return response()->json(['message'=>'deleted'],405);
        // return redirect()->back();
        
    }

}
