@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $title }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @foreach ($breadcrumbs as $breadcrumb)
                                {{-- check active by comparing the URL from $breadcrumb['url'] with the current URL --}}
                                @php
                                    $isActive = url()->current() == $breadcrumb['url'];
                                @endphp

                                <li class="breadcrumb-item {{ $isActive ? 'active' : '' }}">
                                    @if ($isActive)
                                        {{ $breadcrumb['title'] }}
                                    @else
                                        <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['title'] }}</a>
                                    @endif
                                </li>
                            @endforeach
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
                                            Daftar Karyawan
                                        </h3>
                                        <h6 class="mt-1">
                                            Jumlah Karyawan : {{ $jumlah_karyawan }}
                                        </h6>
                                    </div>
                                    <div class="card-tools">
                                        <button type="button" data-block="body"
                                            class="btn btn-sm btn-primary mt-1 ajax_modal"
                                            data-url="{{ route('karyawan.create') }}"><i class="fas fa-plus"></i>
                                            Add Karyawan</button>
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
                                                <th>Tanggal Masuk</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($karyawans as $index => $karyawan)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $karyawan->nik }}</td>
                                                    <td>{{ $karyawan->nama_karyawan }}</td>
                                                    <td>
                                                        @if ($karyawan->kelamin == 'L')
                                                            Laki-Laki
                                                        @else
                                                            Perempuan
                                                        @endif
                                                    </td>
                                                    <td>{{ $karyawan->jabatan->nama_jabatan }}</td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($karyawan->tanggal_masuk)->format('d F Y') }}
                                                    </td>
                                                    <td>{{ $karyawan->status_perkawinan }}</td>
                                                    <td>
                                                        <a href="{{ route('karyawan.edit', $karyawan->id_karyawan) }}"
                                                            class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="deleteKaryawan({{ $karyawan->id }})"><i
                                                                class="fas fa-trash"></i></button>
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
