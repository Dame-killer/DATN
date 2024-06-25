<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public $timestamps = false;

    protected $fillable = ['name', 'image', 'price', 'introduce', 'category_id', 'brand_id'];

    protected $table = 'products';

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the brand that owns the product.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->code = self::generateUniqueCode();
        });
    }

    private static function generateUniqueCode()
    {
        // Định dạng tùy chỉnh: ORD-DDMMYYYY-RANDOMSTRING
        $date = date('dmY');
        $randomString = strtoupper(Str::random(5));
        return "PRD-{$date}-{$randomString}";
    }
}
