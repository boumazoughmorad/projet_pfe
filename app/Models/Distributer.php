<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Distributer extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
       'num_tele',
        'image_path',
        'address',
        'description',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
