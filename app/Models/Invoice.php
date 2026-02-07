<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Invoice extends Model
{
    protected $fillable = [
        'customer_id',
        'user_id',
        'shop_id',
        'invoice_number',
        'invoice_date',
        'goods',
        'discount',
        'tax',
        'total',
        'payment_type',    // ✅ add this
        'amount_paid',     // ✅ add this
        'balance',         // ✅ add this
        'payment_status',  // ✅ add this
    ];


public function getProductNameAttribute()
{
    $goods = $this->goods; // already an array thanks to $casts

    if (empty($goods)) {
        return 'Unknown Product';
    }

    // Check if single product (associative array with 'product_id')
    if (isset($goods['product_id'])) {
        return Product::where('id', $goods['product_id'])->value('name') ?? 'Unknown Product';
    }

    // Multiple products (indexed array)
    $productIds = array_column($goods, 'product_id');
    $names = Product::whereIn('id', $productIds)->pluck('name')->toArray();

    return implode(', ', $names);
}



    

    protected $casts = [
        'goods' => 'array',
    ];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function creator() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function shop() {
        return $this->belongsTo(Shop::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getGoodsArrayAttribute()
    {
        return json_decode($this->goods, true);
    }

public function getQuantityAttribute()
{
    $goods = $this->goods; // already an array

    if (empty($goods)) return 0;

    // Single product
    if (isset($goods['quantity'])) {
        return $goods['quantity'];
    }

    // Multiple products
    return array_sum(array_column($goods, 'quantity'));
}


}

