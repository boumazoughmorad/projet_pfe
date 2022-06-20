<?php

namespace App\Http\Controllers\Products;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    public function getProduct(){
        return response()->json(Product::all(),200);
    }
    public function getProductById($id){
        $product=Product::find($id);
        if(is_null($product)){
            return response()->json(['message'=>'produit introvable'],404);
        }
        return response()->json(Product::find($id),200);
    }
    public function addProduct(Request $request){
    
       // $request->validate([
            // 'name'=>'required',
            // 'producer_id'=>'required',
            // 'quantite'=>'required',
            // 'prix'=>'required',
            // 'categorie_id'=>'required',
            // 'description'=>'required|min:5|max:100',
            // 'stock_id'=>'required',
            // //'image_path' => 'required|mimes:jpg,png|max:2048',
       // ]);

        // if ($file = $request->file('image_path')) {
        //   $path = $file->store('public/products');}
        if ($file = $request->file('image_path')) {
        //     $path = $file->store('public');
        //     $uplod=public_path('public/img');//public_path('/img')

        //    $path= $file->move($uplod,$file->getClientOriginalName());
        if($request->hasFile('image_path'))
        $path=Storage::disk('public')->putFile('profile',$file);
   
            
        }
        $product = new Product([
        'name' => $request->name,
         'producer_id' => $request->producer_id,
         'quantite' => $request->quantite,
         'prix' => $request->prix,
         'categorie_id' => $request->categorie_id,
         'description' => $request->description,
         'quantite_commander' => $request->quantite_commander,
         //'image_path'=> $request->image_path
        //  'statu'=>$statu,
        //  'valid'=>$valid
         ]);

        $product->image_path=$path;
        $save = $product->save();

        if( $save ){
          
            return response()->json(['message'=>'regestered'],200);
        }else{
         
          return response()->json(['message'=>'noooooooooooooooo'],404);
            
        }
       return response()->json(['message'=>'regestered'],200);
    }
    public function updateProduct(Request $request,$id){
        
        // return response()->json(['message'=>$request->name],404);
        $product=Product::find($id);

        if(is_null($product)){
            return response()->json(['message'=>'produit introvable'],404);}
        // }
        // if ($file = $request->file('image_path')) {
        //       if($request->hasFile('image_path'))
        //     $path=Storage::disk('public')->putFile('profile',$file);
       
                
        //     }
       if( $file = $request->file('image_path')){
        if($request->hasFile('image_path'))
        $path=Storage::disk('public')->putFile('profile',$file);
        $product->image_path=$path;}
        $product->update($request->all());
        return response($product,200);

    }
    public function deleteProduct(Request $request,$id){
        $product=Product::find($id);
        if(is_null($product)){
            return response()->json(['message'=>'produit introvable'],404);
        }
        $product->delete();
        return response()->json(['message'=>'deleted'],405);
        
    }
    public function add(Request $request){
        $validateur=Validator::make($request->all(),[
            'name'=>'required',
              'email'=>'required|email|unique:users,email',
              'password'=>'required|min:5|max:30',
              'cpassword'=>'required|min:5|max:30|same:password',
              'address'=>'required|min:5|max:30',
              'country'=>'required|min:5|max:100',
              'city'=>'required|min:5|max:100',
              'image' => 'required|mimes:jpg,png|max:2048',
        ]);
        if($validateur->fails()){
            return respone()->json(['errur'=>$validateur->errors()->all()]);
        }
        $p=new Product([
        'name' => $request->name,
        'producer_id' => $request->producer_id,
        'quantite' => $request->quantite,
        'prix' => $request->prix,
        'categorie_id' => $request->categorie_id,
        'description' => $request->description,
        'stock_id' => $request->stock_id,]);
        $p->save();
        $url="http://localhost:8000/storage/";
        $file = $request->file('image_path');
        $e=$file->getClientOriginalName();
        $path=$request->file('image_path')->storeAs('img',$p->id.'.'.$e);
       // $p->image=$path;
        $p->image_path=$url.$path;
        $p->save();
        }
}
