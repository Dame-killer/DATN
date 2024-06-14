<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public $timestamps = false;

    protected $fillable = ['price', 'quantity', 'introduce', 'product_id', 'size_id', 'color_id'];

    protected $table = 'product_details';

    /**
     * Get the product that owns the product detail.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the size of the product detail.
     */
    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    /**
     * Get the color of the product detail.
     */
    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
