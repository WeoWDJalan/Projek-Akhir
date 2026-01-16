<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';

    protected $fillable = ['name', 'description', 'price', 'stock', 'categories_id'];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'categories_id');
    }
}
