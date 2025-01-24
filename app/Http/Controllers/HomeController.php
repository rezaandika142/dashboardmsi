<?php

namespace App\Http\Controllers;

use App\Models\Ltfu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        
        $totalPasien = Ltfu::count(); // Total pasien
        $ssr = Ltfu::distinct('ssr')->count(); // Jumlah SSR
        $jumlahAlamatUnik = Ltfu::distinct('address')->count(); // Jumlah alamat unik

        $dataRingkasan = [
            'total_pasien' => $totalPasien,
            'jumlah_alamat_unik' => $jumlahAlamatUnik,
            'ssr' => $ssr
        ];

        $ssr = Ltfu::distinct('ssr')->count(); // Jumlah SSR
        $jumlahData = Ltfu::count(); // Jumlah data
        $jumlahAlamatUnik = Ltfu::distinct('address')->count(); // Jumlah alamat unik

        $data = [
            'labels' => ['Jumlah Data', 'Jumlah Alamat', 'SSR'],
            'values' => [
                $jumlahData,
                $jumlahAlamatUnik,
                $ssr
            ],
        ];

        return view('home', compact('data', 'dataRingkasan'));
    }
}