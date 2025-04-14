<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailtransaksi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function meja() {
        return $this->belongsTo(Meja::class,'meja_id','id');
    }
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }




    // public function makanan()
    // {
    //     return $this->belongsTo(Makanan::class, 'makanan_id');
    // }

    // public function minuman()
    // {
    //     return $this->belongsTo(Minumen::class, 'minumen_id');
    // }

    // public function getProdukAttribute()
    // {
    //     return $this->makanan ?? $this->minuman;
    // }

    // public function produk()
    // {
    //     return $this->makanan_id ? $this->belongsTo(Makanan::class, 'makanan_id') : $this->belongsTo(Minumen::class, 'minumen_id');
    // }
}
