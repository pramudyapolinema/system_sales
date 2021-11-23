<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndonesiaCity extends Model
{
    use HasFactory;

    protected $table = "indonesia_cities";

    public function pelanggan(){
        return $this->hasMany(User::class);
    }
}
