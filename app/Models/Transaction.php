<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_transaksi',
        'id_customer',
        'berat',
        'ongkir',
        'total_bayar',
        'status',
        'resi',
    ];

    public function pelanggan() {
        return $this->belongsTo(User::class, 'id_customer', 'id');
    }

    public function produktransaksi() {
        return $this->hasMany(ProductTransaction::class, 'id_transaksi', 'id_transaksi');
    }
}
