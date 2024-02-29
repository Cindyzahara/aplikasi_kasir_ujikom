<?php

namespace App\Models;

use App\Traits\HashFormatRupiah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;
    use HashFormatRupiah;

    protected $guarded = ['id'];
    protected $table = 'produk';

    public function detailpenjualan() 
    {
        return $this->hasMany(DetailPenjualan::class);
    }
}
