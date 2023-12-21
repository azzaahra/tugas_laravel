<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_staff';

    protected $fillable = [
        'nama_staff',
        'alamat',
        'jabatan',
    ];

   
}


 
