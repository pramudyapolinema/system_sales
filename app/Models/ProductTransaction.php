<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_transaksi',
        'id_product',
        'jumlah',
        'total_berat',
        'catatan',
        'total',
    ];

    public function produk() {
        return $this->belongsTo(Product::class, 'id_product', 'id');
    }

    public function produktransaksi() {
        return $this->belongsTo(Transaction::class, 'id_transaksi', 'id_transaksi');
    }
}
