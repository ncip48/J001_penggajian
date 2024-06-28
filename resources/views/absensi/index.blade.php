@extends('layouts.app')

@section('title', 'Absensi')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Absensi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item ">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Master Data</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Data Absensi
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column">
                                        <h3 class="card-title mt-1">
                                            Daftar Absensi
                                        </h3>
                                    </div>
                                    <div class="card-tools">
                                        <a class="btn btn-sm btn-primary mt-1" href="{{ route('absensi.create') }}"><i
                                                class="fas fa-plus"></i>
                                            Add Absensi</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsives">
                                    <table class="table table-striped table-hover table-full-width" id="main_table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>NIK</th>
                                                <th>Nama</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Jabatan</th>
                                                <th>Hadir</th>
                                                <th>Izin</th>
                                                <th>Alpha</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($absensis as $index => $absensi)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $absensi->karyawan->nik }}</td>
                                                    <td>{{ $absensi->karyawan->nama_karyawan }}</td>
                                                    <td>
                                                        @if ($absensi->karyawan->kelamin == 'L')
                                                            Laki-Laki
                                                        @else
                                                            Perempuan
                                                        @endif
                                                    </td>
                                                    <td>{{ $absensi->karyawan->jabatan->nama_jabatan }}</td>
                                                    <td>{{ $absensi->masuk }}</td>
                                                    <td>{{ $absensi->izin }}</td>
                                                    <td>{{ $absensi->alpha }}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="{{ route('absensi.edit', $absensi->id_absensi) }}"
                                                                class="btn btn-sm btn-warning"><i
                                                                    class="fas fa-edit"></i></a>
                                                            <form data-reload="true" id="main-form"
                                                                action="{{ route('absensi.destroy', $absensi) }}"
                                                                method="POST" class="ml-1 delete-form">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="confirm-text btn btn-sm btn-danger">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{-- {{ $asets->links('vendor.pagination.bootstrap-4') }} --}}
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
