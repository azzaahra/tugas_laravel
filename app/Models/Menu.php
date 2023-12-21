<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_menu';

    protected $fillable = [
        'nama_menu',
        'deskripsi',
        'harga',
    ];

    public function orders(){
        return $this->hasMany(Order::class, 'id_menu');
    }
}
