<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_obat';

    protected $with = ['satuan', 'kategori'];

    public function satuan()
    {
        return $this->belongsTo(SatuanObat::class, 'id_satuan');
    }
    public function kategori()
    {
        return $this->belongsTo(KategoriObat::class, 'id_kategori');
    }
}
