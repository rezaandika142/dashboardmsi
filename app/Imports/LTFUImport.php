<?php

namespace App\Imports;

use App\Models\Ltfu; // Pastikan model Ltfu sudah dibuat
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LTFUImport implements ToModel, SkipsEmptyRows, WithHeadingRow
{
    public function model(array $row)
    {
        return new Ltfu([
            'sr' => $row['sr'],
            'ssr' => $row['ssr'],
            'province' => $row['province'],
            'city' => $row['city'],
            'patient_name' => $row['patient_name'],
            'month' => $row['month'],
            'nik' => (string)$row['nik'],
            'gender' => $row['gender'],
            'age' => (int)$row['age'],
            'subdistrict' => $row['subdistrict'],
            'address' => $row['address'],
            'remarks' => $row['remarks'],
        ]);
    }
}
