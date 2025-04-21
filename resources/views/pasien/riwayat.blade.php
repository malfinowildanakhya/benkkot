@extends('layout')

@section('sidebar')
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                                       with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ route('pasien.dashboard') }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('pasien.periksa') }}" class="nav-link">
                    <p>
                        Periksa
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('pasien.riwayat') }}" class="nav-link active">
                    <p>
                        Riwayat
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Riwayat Periksa</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right"
                                    placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Dokter</th>
                                    <th>Tanggal Periksa</th>
                                    <th>Biaya Periksa</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($riwayats as $riwayat)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $riwayat->dokter->nama }}</td>
                                        <td>{{ \Carbon\Carbon::parse($riwayat->tgl_periksa)->format('d-m-Y') }}</td>
                                        <td>
                                            @if(is_null($riwayat->biaya_periksa))
                                                <span class="badge badge-danger">Belum Ada</span>
                                            @else
                                                <span class="badge badge-success">Rp {{ number_format($riwayat->biaya_periksa, 0, ',', '.') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#modalDetail{{ $riwayat->id }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal Section -->
                    @foreach($riwayats as $riwayat)
                    <div class="modal fade" id="modalDetail{{ $riwayat->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $riwayat->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel{{ $riwayat->id }}">Detail Pemeriksaan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Dokter:</strong> {{ $riwayat->dokter->nama }}</p>
                                    <p><strong>Tanggal Periksa:</strong> {{ \Carbon\Carbon::parse($riwayat->tgl_periksa)->format('d-m-Y H:i') }}</p>
                                    <p>
                                        <strong>Biaya:</strong>
                                        @if(is_null($riwayat->biaya_periksa))
                                            <span class="text-danger">Belum Diinput</span>
                                        @else
                                            Rp {{ number_format($riwayat->biaya_periksa, 0, ',', '.') }}
                                        @endif
                                    </p>
                                    <p>
                                        <strong>Catatan:</strong>
                                        @if(is_null($riwayat->catatan))
                                            <span class="text-danger">Belum Ada Catatan</span>
                                        @else
                                            {{ $riwayat->catatan }}
                                        @endif
                                    </p>
                                    <p><strong>Obat:</strong></p>
                                    <ul>
                                        @foreach($riwayat->detailPeriksa ?? [] as $detail)
                                            <li>{{ $detail->obat->nama_obat ?? '-' }} | {{ $detail->obat->kemasan ?? '-' }} </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->

        <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection