@extends('Admin.layouts.index')

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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
