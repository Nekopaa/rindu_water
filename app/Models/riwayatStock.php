<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatStock extends Model
{
    use HasFactory;

    protected $table = 'riwayat_stock';
    protected $primaryKey = 'id_riwayat';

    protected $fillable = [
        'id_produk',
        'jenis_perubahan',
        'jumlah',
        'tanggal_perubahan',
        'keterangan',
    ];

    public function produk()
    {
        return $this->belongsTo(ProdukAir::class, 'id_produk', 'id_produk');
    }
}
