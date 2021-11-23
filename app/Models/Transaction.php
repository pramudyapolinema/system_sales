<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_customer',
        'berat',
        'ongkir',
        'total_bayar',
        'status',
    ];

    public function pelanggan() {
        return $this->belongsTo(User::class, 'id_customer', 'id');
    }
}
