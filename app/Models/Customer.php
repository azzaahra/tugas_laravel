<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_customer';

    protected $fillable = [
        'nama_customer',
        'email',
        'no_hp',
        'alamat',
    ];

    public function orders(){
        return $this->hasMany(Order::class, 'id_customer');
    }
}
