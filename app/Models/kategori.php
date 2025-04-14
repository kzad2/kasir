<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;

    protected $guarded=['id'];

    public function menu()  {
        return $this->hasMany(Menu::class, 'kategori_id');
    }
    // public function makanan()  {
    //     return $this->hasMany(makanan::class,'kategori_id');
    // }
    // public function minuman()  {
    //     return $this->hasMany(minumen::class,'kategori_id');
    // }
}
