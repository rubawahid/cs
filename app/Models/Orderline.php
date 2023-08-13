<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Orderline extends Pivot
{
    use HasFactory;

    protected $table = 'order_lines';

    public $timestamps = false; // Disable timestamps columns (created_at as & updated_at)

    protected $fillable = [
        'order_id', 'product_id', 'product_name', 'price', 'quantity',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault([
            'name' => $this->produt_name,
            'price' => $this->price,
            ''
        ]);
    }
}
