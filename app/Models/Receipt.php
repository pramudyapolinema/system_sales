<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'alamat',
        'metode_pembayaran',
        'resi',
        'subtotal_product',
        'subtotal_pengiriman',
        'voucher',
        'total_pembayaran',
    ];
}
