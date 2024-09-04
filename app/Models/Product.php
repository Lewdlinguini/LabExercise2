<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Specify the table name if it's not the plural form of the model name
    protected $table = 'products';

    // Specify which attributes are mass assignable
    protected $fillable = [
        'product_name',
        'description',
        'price',
        'stock',
        'image', // Add 'image' to the fillable attributes
    ];

    // Optional: Define any relationships if needed, e.g., with a Category model
    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }

    // Optional: Define any custom methods for business logic
    public function calculateDiscountedPrice($discountPercentage)
    {
        return $this->price - ($this->price * ($discountPercentage / 100));
    }

    // Optional: Accessor for formatted price
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2);
    }
}