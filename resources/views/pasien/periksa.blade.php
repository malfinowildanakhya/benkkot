@extends('layout')

@section('sidebar')
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('pasien.dashboard') }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('pasien.periksa') }}" class="nav-link active">
                    <p>
                        Periksa
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('pasien.riwayat') }}" class="nav-link ">
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

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Periksa</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('pasien.periksaStore') }}" method="POST">
                            @csrf  {{-- Tambahkan token CSRF --}}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleSelectRounded0">Pilih Dokter</label>
                                    <select class="custom-select rounded-0" id="exampleSelectRounded0" name="id_dokter">
                                        @foreach($dokters as $dokter)
                                            <option value="{{ $dokter->id }}">{{ $dokter->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleDateTime">Pilih Tanggal & Waktu</label>
                                    <input type="datetime-local" class="form-control" id="exampleDateTime" name="tgl_periksa" value="{{ old('tanggal_periksa', now()->format('Y-m-d\TH:i')) }}">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

<!-- bs-custom-file-input -->
<script src="{{ asset('lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

<script>
    $(function() {
        bsCustomFileInput.init();
    });
</script>