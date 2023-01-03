<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    public $table = 'carts';
    
    protected $fillable = [
        'product_id',
        'quantity',
        'price',
        'user_id',
        'created_at',
        'updated_at'	

    ];

    public function product()
    {
        return $this->hasMany(Product::class,'id','product_id');
    }
}
