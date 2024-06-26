<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    /**
     * Get the order that owns the order detail.
     */

    public $timestamps = false;

    protected $fillable = ['order_id', 'product_detail_id', 'unit_price', 'amount'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the product detail associated with the order detail.
     */
    public function productDetail()
    {
        return $this->belongsTo(ProductDetail::class);
    }
}
