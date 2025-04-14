<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function detailTransaksi() {
        return $this->hasMany(DetailTransaksi::class, 'transaksi_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
