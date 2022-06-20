<?php

namespace App\Http\Controllers\Commande;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
   
    public function getCommande(){
        return response()->json(Commande::all(),200);
    }
    public function getCommandeById($id){
        $Commande=Commande::find($id);
        if(is_null($Commande)){
            return response()->json(['message'=>'produit introvable'],404);
        }
        return response()->json(Commande::find($id),200);
    }
    public function deleteCommande(Request $request,$id){
        $Commande=Commande::find($id);
        if(is_null($Commande)){
            return response()->json(['message'=>'produit introvable'],404);
        }
        $Commande->delete();
        return response()->json(['message'=>'deleted'],405);
        
    }
    public function addComanade(Request $request){
    
      
        $Commande = new Commande([
        'user-id' => $request->user-id,
         'address' => $request->address,
         'products' => $request->products,
         'prix_total' => $request->prix,
         'date_orders' => $request->date_orders,
         ]);
        
        $save = $Commande->save();

        if( $save ){
          
            return response()->json(['message'=>'regestered'],200);
        }else{
         
          return response()->json(['message'=>'noooooooooooooooo'],404);
            
        }
    }
    public function updateCommande(Request $request,$id){
        $Commande=Commande::find($id);
        if(is_null($Commande)){
            return response()->json(['message'=>'produit introvable'],404);
        }
        $Commande->update($request->all());
        return response($Commande,200);

    }
    
}


