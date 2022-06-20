<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
class Commande extends Model
{
    use HasFactory;
    
    use SoftDeletes;
    protected $dates=['deleted_at'];
    protected $fillable = [
        'client_id',
        'quantity',
        'products_id',
        // 'distriduter_id',
        'products_id',
        // 'date_orders',
        'prix_totale',
        
    ];
}
