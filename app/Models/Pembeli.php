<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    protected $fillable = [
        "nama_pembeli",
        "alamat",
        "telpon",
        "nama_produk",
        "jumlah",
        "total",
        "note", 
        "tanggal_pesan",
        "tanggal_kirim",
    ];
}
