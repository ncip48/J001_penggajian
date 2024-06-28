<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{

    public function __construct()
    {
        $this->url = url('/karyawan');
        $this->title = "Karyawan";
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumbs = [
            ["url" => "#", 'title' => "Home"],
            ['url' => $this->url, 'title' => $this->title],
        ];

        $karyawans = Karyawan::with('jabatan')->get();
        $jumlah_karyawan = Karyawan::count();
        return view('karyawan.index')
            ->with('title', $this->title)
            ->with('breadcrumbs', $breadcrumbs)
            ->with('jumlah_karyawan', $jumlah_karyawan)
            ->with('karyawans', $karyawans);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
