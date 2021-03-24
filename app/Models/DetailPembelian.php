<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    use HasFactory;

    protected $with = ['obat'];

    protected $primaryKey = 'id_detail_pembelian';

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'no_batch', 'no_batch');
    }
}
