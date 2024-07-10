<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public $timestamps = false;

    protected $fillable = ['receiver', 'address', 'phone', 'order_date', 'updated_date', 'status', 'payment_status', 'tracking_code', 'user_id', 'payment_method_id'];

    protected $table = 'orders';

    /**
     * Get the user that placed the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the payment method used for the order.
     */
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->code = self::generateUniqueCode();
        });
    }

    private static function generateUniqueCode()
    {
        // Định dạng tùy chỉnh: ORD-DDMMYYYY-RANDOMSTRING
        $date = date('dmY');
        $randomString = strtoupper(Str::random(5));
        return "ORD-{$date}-{$randomString}";
    }
}
