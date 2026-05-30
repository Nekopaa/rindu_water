<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;

    protected $table = 'detail_pesanan';
    protected $primaryKey = 'id_detail';

    protected $fillable = [
        'id_transaksi',
        'id_produk',
        'jumlah',
        'harga_satuan',
    ];

    public function produk()
    {
        return $this->belongsTo(ProdukAir::class, 'id_produk', 'id_produk');
    }
}
