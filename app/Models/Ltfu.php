<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Ltfu extends Model // Ubah dari LTFU menjadi Ltfu
{
    use HasFactory;

    protected $table = 'ltfu'; // Nama tabel

    protected $fillable = [ 
        'sr',
        'ssr',
        'province',
        'city',
        'patient_name',
        'nik',
        'gender',
        'age',
        'subdistrict',
        'address',
        'month',
        'remarks',
    ];
}