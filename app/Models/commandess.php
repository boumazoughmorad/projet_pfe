<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class commandess extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates=['deleted_at'];
    protected $fillable = [
        'distrubiteur_id',
        'panier_id',
        // 'client_id',
        'prix_totale_orders',
        'statu',
        'date_orders',
        'date_livraison',
        'transport',
        'report',
    ];
    protected $hidden=['created_at','updated_at'];
}
