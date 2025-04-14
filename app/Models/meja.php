<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Meja extends Model
{
    use HasFactory;

    protected $guarded=['id'];
    protected $fillable = [
        'nomor_meja',
        'status',
    ];
    public function meja()  {
        return $this->belongsTo(user::class);
    }
    public function detailtransaksi()  {
        return $this->hasMany(detailtransaksi::class);
    }
}


