<?php
namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use SoftDeletes;

    protected $fillable = ['name', 'price', 'stock'];
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
    public function batches()
    {
        return $this->hasMany(Batch::class);
    }
}
