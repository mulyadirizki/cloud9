<?php

namespace App\Imports;

use App\Models\Pelanggan;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Auth;
use App\Models\Pembayaran;

class PelangganImport implements ToModel, WithStartRow, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        $permitted_chars = '0123456789';
        $idGenerate = substr(str_shuffle($permitted_chars), 0, 4);
        $sekarang  =  new \DateTime();
        $today = $sekarang->format('ymd');
        $kodeBaru = $today . $idGenerate;

        Pelanggan::create([
            'id_pelanggan' => $kodeBaru,
            'nama_pelanggan' => $row['nama'],
            'perumahan' => $row[2],
            'alamat' => $row['nama_blok'],
            'tagihan' => $row['tagihan'],
            'paket' => $row['net_mbps'],
            'tv' => $row['tv'],
            'sn' => '0',
            'chip_id' => '0',
            'tgl_pemasangan' => $row['tgl_pasang'],
            'tgl_tagihan' => $row['jt_tempo_tgl'],
            'telp_hp' => $row['telp_hp'],
            'status' => '0',
        ]);

        $petugas = Auth::user()->name;
        $kodePembayaran = 'TR'. $today . $idGenerate;
        Pembayaran::create([
            'id_pembayaran' => $kodePembayaran,
            'pelanggan_id' => $kodeBaru,
            'jml_dibayar' => '0',
            'bulan_dibayar' => '0',
            'status_pembayaran' => '0',
            'log_petugas' => $petugas,
        ]);
    }
}
