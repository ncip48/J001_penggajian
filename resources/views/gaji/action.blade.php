<?php
$is_edit = isset($data);
?>

@extends('layouts.app')

@section('title', $is_edit ? 'Edit Gaji' : 'Tambah Gaji')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $is_edit ? 'Edit' : 'Tambah' }} Gaji</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item ">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Transaksi</a>
                            </li>
                            <li class="breadcrumb-item active">
                                {{ $is_edit ? 'Edit' : 'Tambah' }} Gaji
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ $is_edit ? 'Edit' : 'Tambah' }} Gaji</h3>
                            </div>
                            <form id="main-form" action="{{ $is_edit ? route('gaji.update', $data) : route('gaji.store') }}"
                                method="POST" autocomplete="off" data-back="{{ route('gaji.index') }}">
                                @csrf
                                {!! $is_edit ? method_field('PUT') : '' !!}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="id_karyawan">Karyawan</label>
                                        <select class="custom-select form-control-sm" id="id_karyawan" name="id_karyawan">
                                            <option value="" selected disabled>Pilih Karyawan</option>
                                            @foreach ($karyawans as $item)
                                                <option value="{{ $item->id_karyawan }}"
                                                    @if (isset($data->id_karyawan) && $item->id_karyawan == $data->id_karyawan) selected @endif>
                                                    {{ $item->nama_karyawan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="periode_gaji">Periode</label>
                                        <input type="month" class="form-control" id="periode_gaji" name="periode_gaji"
                                            value="{{ isset($data->periode_gaji) ? $data->periode_gaji : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="gaji_pokok">Gaji Pokok</label>
                                        <input type="text" class="form-control" id="gaji_pokok" name="gaji_pokok"
                                            value="{{ isset($data->gaji_pokok) ? $data->gaji_pokok : '' }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="potongan_gaji">Potongan Gaji</label>
                                        <input type="text" class="form-control" id="potongan_gaji" name="potongan_gaji"
                                            value="{{ isset($data->potongan_gaji) ? $data->potongan_gaji : '' }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="total_lembur">Total Lembur (jam)</label>
                                        <input type="text" class="form-control" id="total_lembur" name="total_lembur"
                                            value="{{ isset($data->total_lembur) ? $data->total_lembur : '' }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="total_bonus">Total Bonus</label>
                                        <input type="text" class="form-control" id="total_bonus" name="total_bonus"
                                            value="{{ isset($data->total_bonus) ? $data->total_bonus : '' }}">
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button id="btn-save" type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@push('scripts')
    <script>
        $('#id_karyawan, #periode_gaji').on('change', function() {
            const id_karyawan = $('#id_karyawan').val();
            const periode = $('#periode_gaji').val();
            if (id_karyawan && periode) {
                const bulan = periode.split('-')[1]
                const tahun = periode.split('-')[0]

                $.ajax({
                    url: "{{ route('absen.lembur.cari') }}",
                    method: 'POST',
                    data: {
                        'id_karyawan': id_karyawan,
                        'bulan': bulan,
                        'tahun': tahun
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data)
                        if (data.success) {
                            $('#gaji_pokok').val(data?.data?.gaji_pokok)
                            $('#potongan_gaji').val(data?.data?.potongan)
                            $('#total_lembur').val(data?.data?.lembur)
                        } else {
                            toastr.error(data?.message)
                        }
                    },
                    error: function(err) {
                        toastr.error(err.statusText)
                    }
                });
            }
        });
    </script>
@endpush
