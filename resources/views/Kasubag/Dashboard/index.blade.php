@extends('Kasubag.layouts.index')

@section('container')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Dashboard</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4"> <!-- Use col-md-6 to split the row in half -->
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Jumlah Absensi</h5>
                                    <p class="card-text">
                                        Total: {{ $totalAbsences }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4"> <!-- Use col-md-6 to split the row in half -->
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Jumlah Pegawai</h5>
                                    <p class="card-text">
                                        Total: {{ $totalPegawai }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @foreach ($filteredFiles as $file)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $file->name }}</h5>
                                        <p class="card-text">
                                            Tanggal Upload: {{ $file->file_date_created }} <br>
                                            Waktu Upload: {{ $file->file_time_created }}
                                        </p>
                                        <p class="card-text"> Keterangan File: {{ $file->criteria_file }}</p>
                                        <a href="{{ url('kasubag/Files/private/files/' . $file->id) }}"
                                            class="btn btn-primary">Lihat Detail</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
