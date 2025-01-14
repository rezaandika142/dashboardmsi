<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LTFU extends Model
{
    use HasFactory;

    // Nama tabel (opsional jika tabelnya bukan 'ltfus')
    protected $table = 'ltfu';
    

    // Kolom-kolom yang dapat diisi (mass assignable)
    protected $fillable = [ 
        'name',
        'age',
        'address',
    ];
}