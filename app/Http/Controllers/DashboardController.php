<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;

class DashboardController extends Controller
{
    public function index()
    {
        $today = today();

        $habis_30_hari = Pegawai::whereBetween('tanggal_habis_kontrak', [$today, $today->copy()->addDays(30)])->count();
        $habis_60_hari = Pegawai::whereBetween('tanggal_habis_kontrak', [$today->copy()->addDays(31), $today->copy()->addDays(60)])->count();
        $habis_90_hari = Pegawai::whereBetween('tanggal_habis_kontrak', [$today->copy()->addDays(61), $today->copy()->addDays(90)])->count();
        $sudah_lewat = Pegawai::where('tanggal_habis_kontrak', '<', $today)->count();

        return view('dashboard.index', compact('habis_30_hari', 'habis_60_hari', 'habis_90_hari', 'sudah_lewat'));
    }
}
