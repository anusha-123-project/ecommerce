<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'cat_id', 'price', 'stock','status'];

    public function images()
    {
        return $this->hasMany(Media::class, 'product_id');
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }
}
