<?php

namespace App\Models;
use App\Models\Category;
use App\Models\Product_Images;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'status',
        'brand',
        'quantity',
        'small_description',
        'original_price',
        'selling_price',
        'trending',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'category_id'



    ];
     

    public function category()
    {
        return $this->belongsTo(Categories:: class, 'category_id','id');
    }

    public function product__images()
    {
        return $this->hasMany(Product_Images::class, 'product_id', 'id');
    }
}
