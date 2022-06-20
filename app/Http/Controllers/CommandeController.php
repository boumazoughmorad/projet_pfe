<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
class CommandeController extends Controller
{
    
    
    function Create(Request $request){
        
        // return response()->json(['message'=>'Fin'],200);
          $Commande = new Commande([
          'client_id' => $request->client_id ,
           'quantity' => $request->quantity,
           'products_id' =>$request->products_id,
        //    'distriduter_id'=>$request->distriduter_id,
           'prix_totale'=>$request->prix_totale,
            // 'num_accont_banque'=>$request->num_accont_banque,
              // 'address_stock'=>$request->address_stock,
            //   'date_orders'=>new DateTime('today'),
            // 'date_orders'=>Carbon::new(),
        ]);
          
          $save = $Commande->save();
          

          if( $save ){
            
              return response()->json(['message'=>'regestered'],200);
          }else{
           
            return response()->json(['message'=>'noooooooooooooooo'],404);
              
          }
    }
    public function getAllCommandes(Request $request){
        $commandess=Commande::withTrashed()->get();
        return response()->json($commandess,200);
        
 
     }
  
    
    public function deleteCommande(Request $request,$id){
        $Commande=Commande::find($id);
        if(is_null($Commande)){
            return response()->json(['message'=>'produit introvable'],404);
        }
        $Commande->delete();
        return response()->json(['message'=>'deleted'],405);
        
    }
    
    public function getCommande(){
        return response()->json(Commande::all(),200);}
    // }
    public function getCommandeById($id){
        $Commande=Commande::find($id);
        if(is_null($Commande)){
            return response()->json(['message'=>'Commande introvable'],404);
        }
        return response()->json(Commande::find($id),200);
    }
    // public function updateCommande(Request $request,$id){
    //     $Commande=Commande::find($id);
    //     if(is_null($Commande)){
    //         return response()->json(['message'=>'Commande introvable'],404);
    //     }
    //     $Commande->update($request->all());
    //     return response($Commande,200);

    // }
    // public function deleteCommande(Request $request,$id){
    //     $Commande=Commande::find($id);
    //     if(is_null($Commande)){
    //         return response()->json(['message'=>'Commande introvable'],404);
    //     }
    //     $Commande->delete();
    //     return response()->json(['message'=>'deleted'],405);
        
    // }
}
