<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_karyawan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_user',
        'id_jabatan',
        'nik',
        'nama_karyawan',
        'kelamin',
        'agama',
        'alamat_tinggal',
        'no_telepon',
        'tempat_lahir',
        'tanggal_lahir',
        'status_perkawinan',
        'tanggal_masuk'
    ];
}
