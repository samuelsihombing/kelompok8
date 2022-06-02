<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan_makanan_minuman';
    protected $primaryKey = 'id_pemesanan_makanan_minuman';

    protected $fillable = ['kode_transaksi', 'tanggal_pemesanan_makanan_minuman','total_pembayaran','total_item','status','id_user','nama_penerima','nomor_telephone','catatan'];

    public function details(){
        return $this->hasMany(PemesananDetail::class, "id_pemesanan", "id_pemesanan_makanan_minuman");
    }

    public function user(){
        return $this->belongsTo(User::class, "id_user", "id_user");
    }
}
