<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $absensis = Absensi::all();
        return view('absensi.index')
            ->with('absensis', $absensis);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawans = Karyawan::all();
        return view('absensi.action')
            ->with('karyawans', $karyawans);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_karyawan' => 'required',
            'bulan' => 'required',
            'masuk' => 'required',
            'izin' => 'required',
            'alpha' => 'required',
        ], [
            'id_karyawan.required' => 'Karyawan tidak boleh kosong',
            'bulan.required' => 'Bulan tidak boleh kosong',
            'masuk.required' => 'Jumlah hari masuk tidak boleh kosong',
            'izin.required' => 'Jumlah hari izin tidak boleh kosong',
            'alpha.required' => 'Jumlah hari alpha tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->all() as $error) {
                $errors[] = $error;
            }
            return $this->setResponse(false, "Validation Error", $errors);
        }

        $request['bulan'] = $request['bulan'] . '-01';
        Absensi::create($request->all());

        return $this->setResponse(true, "Sukses membuat absensi");
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
        $karyawans = Karyawan::all();
        $data = Absensi::find($id);
        return view('absensi.action')
            ->with('data', $data)
            ->with('karyawans', $karyawans);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->removeUnused($request);

        $validator = Validator::make($request->all(), [
            'id_karyawan' => 'required',
            'bulan' => 'required',
            'masuk' => 'required',
            'izin' => 'required',
            'alpha' => 'required',
        ], [
            'id_karyawan.required' => 'Karyawan tidak boleh kosong',
            'bulan.required' => 'Bulan tidak boleh kosong',
            'masuk.required' => 'Jumlah hari masuk tidak boleh kosong',
            'izin.required' => 'Jumlah hari izin tidak boleh kosong',
            'alpha.required' => 'Jumlah hari alpha tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->all() as $error) {
                $errors[] = $error;
            }
            return $this->setResponse(false, "Validation Error", $errors);
        }

        $request['bulan'] = $request['bulan'] . '-01';
        Absensi::where('id_absensi', $id)->update($request->all());

        return $this->setResponse(true, "Sukses update absensi");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Absensi::findOrFail($id);
        $delete->delete();

        if ($delete) {
            return $this->setResponse(true, "Sukses hapus absensi");
        } else {
            return $this->setResponse(true, "Gagal update absensi");
        }
    }
}
