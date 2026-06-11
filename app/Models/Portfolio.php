<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    // KODINGAN BARU: Menggunakan guarded kosong agar semua field (termasuk deskripsi) bebas disimpan
    protected $guarded = [];

    public function galleries()
    {
        return $this->hasMany(PortfolioGallery::class, 'portfolio_id', 'id');
    }
}