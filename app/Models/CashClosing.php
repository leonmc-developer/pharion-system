<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashClosing extends Model
{
    protected $fillable = [
        'date',
        'total',
        'sales_count',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
