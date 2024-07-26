<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsReceipt extends Model
{
    use HasFactory;


    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'quantity',
        'unit_price',
        'subtotal',
        'product_id',
        'receipt_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function receipt()
    {
        return $this->belongsTo(Receipt::class);
    }
}
