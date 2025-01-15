<?php

namespace App\Http\Controllers;

use App\Models\Ltfu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $dummyData = 50;
        $totalPasien = Ltfu::count(); // Total pasien
        $jumlahAlamatUnik = Ltfu::distinct('address')->count(); // Jumlah alamat unik

        $dataRingkasan = [
            'total_pasien' => $totalPasien,
            'jumlah_alamat_unik' => $jumlahAlamatUnik,
            'dummyData' => $dummyData
        ];

        $totalUsia = Ltfu::sum('age');
        $jumlahData = Ltfu::count();
        $jumlahAlamatUnik = Ltfu::distinct('address')->count();

        $data = [
            'labels' => ['Jumlah Data', 'Jumlah Alamat', 'Dummy Data'],
            'values' => [
                $jumlahData,
                $jumlahAlamatUnik,
                $dummyData
            ],
        ];

        return view('home', compact('data', 'dataRingkasan'));
    }
}