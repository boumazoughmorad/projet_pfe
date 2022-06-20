<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable=['name',
    'producer_id',
    'description',
    'quantite',
    'prix',
    'image_path',
    'categorie_id',
    'quantite_commander',
    'valid',
    'statu',
];
public function getPrice(){
    $price=$this->price/100;
    return number_format($price,2,',',' ').' dh';
}
}
