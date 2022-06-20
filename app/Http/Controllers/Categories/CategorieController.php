<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorie;
class CategorieController extends Controller
{
    public function addCategorie(Request $request){
   // return response()->json(['message'=>'regestered'],200);
        $request->validate([
            'name'=>'required',
            'description'=>'required|min:5|max:100',
        ]);

       

        $catego = new Categorie([
        'name' => $request->name,
         'description' => $request->description,
         ]);
         
        $save = $catego->save();

        if( $save ){
          
            return response()->json(['message'=>'regestered'],200);
        }else{
         
          return response()->json(['message'=>'noooooooooooooooo'],404);
            
        } 
    }
    public function getcate(){
        return response()->json(Categorie::all(),200);
    }
    public function getgategorieById($id){
        $gategorie=Categorie::find($id);
        if(is_null($gategorie)){
            return response()->json(['message'=>'Categorie introvable'],404);
        }
        return response()->json(Categorie::find($id),200);
    }
}
