<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;

class StockControlle extends Controller
{
    public function getstok(){
        return response()->json(Stock::all(),200);
    }
    public function addStock(Request $request){
    $request->validate([
        
        'name'=>'required',
        'producer_id'=>'required',
        'address'=>'required|min:5|max:100',
    ]);

   

    $stock = new Stock([
    'name' => $request->name,
     'address' => $request->address,
     'producer_id' => $request->producer_id,
     ]);
     
    $save = $stock->save();

    if( $save ){
      
        return response()->json(['message'=>'regestered'],200);
    }else{
     
      return response()->json(['message'=>'noooooooooooooooo'],404);
        
    }
}
}
