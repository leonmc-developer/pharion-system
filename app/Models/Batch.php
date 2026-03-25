<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $fillable = [
        'product_id',
        'quantity',
        'expiration_date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }    
}