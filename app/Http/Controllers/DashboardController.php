<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data_karyawan = Karyawan::count();
        $data_admin = User::where('level', 0)->count();
        $data_jabatan = Jabatan::count();
        $data_kehadiran = 0;
        return view('dashboard')
            ->with('data_karyawan', $data_karyawan)
            ->with('data_admin', $data_admin)
            ->with('data_jabatan', $data_jabatan)
            ->with('data_kehadiran', $data_kehadiran);
    }
}
