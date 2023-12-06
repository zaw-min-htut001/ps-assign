<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

      protected $fillable = [
        'item_name',
        'price',
        'description',
        'item_condition',
        'item_type',
        'status',
        'item_photo',
        'owner_name',
        'contact_number',
        'address',
        'category'
    ];
}
