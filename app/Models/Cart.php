<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_customer',
        'id_product',
        'jumlah',
        'catatan',
        'total',
    ];

    public function pelanggan() {
        return $this->belongsTo(User::class, 'id_customer', 'id');
    }

    public function produk() {
        return $this->belongsTo(Product::class, 'id_product', 'id');
    }
}
