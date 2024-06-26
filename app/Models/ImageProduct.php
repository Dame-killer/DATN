<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageProduct extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public $timestamps = false;

    protected $fillable = ['url', 'product_detail_id'];

    protected $table = 'image_products';

    /**
     * Get the product detail that owns the image.
     */
    public function productDetail()
    {
        return $this->belongsTo(ProductDetail::class);
    }
}
