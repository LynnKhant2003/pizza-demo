<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pizzas extends Model
{
    use HasFactory;
     protected $fillable=
         [
             'pizza_id',
             'name',
             'image',
             'price',
             'publish_status',
             'category_id',
             'discount_price',
             'buy1_get1_status',
             'waiting_time',
             'description',
         ];

}
