<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'image_url',
        'name',
        'description',
        'price',
        'stock_quantity',
        'categorie_id',
        'state_id',
        'supplier_id',
    ];

    public function Categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
