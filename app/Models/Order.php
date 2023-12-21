<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_order';

    protected $fillable = [
        'id_customer',
        'id_menu',
        'jumlah',
        'total_harga',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function menu(){
        return $this->belongsTo(Menu::class, 'id_menu');
    }
}
