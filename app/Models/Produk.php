<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
  protected $fillable = [
    "foto",
    "nama_produk",
    "deskripsi",
    "harga",
    "jenis_kue",
    "status",
  ];
}
