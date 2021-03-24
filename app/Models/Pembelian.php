<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier', 'id_supplier');
    }

    public function akun()
    {
        return $this->belongsTo(User::class, 'id_akun');
    }

    public function detail()
    {
        return $this->hasMany(DetailPembelian::class, 'id_pembelian');
    }
}
