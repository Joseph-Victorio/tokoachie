<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewPembeli extends Model
{
    protected $fillable = [
        "foto",
        "nama_klien",
        "isi_review",
    ];
}
