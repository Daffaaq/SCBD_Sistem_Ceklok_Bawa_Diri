@extends('Pegawai.layouts.index')

@section('container')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Daftar File</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($filteredFiles as $file)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $file->name }}</h5>
                                        <p class="card-text">
                                            Tanggal Upload: {{ $file->file_date_created }} - {{ $file->file_time_created }}
                                        </p>
                                        <p class="card-text">{{ $file->criteria_file }}</p>
                                        <a href="{{ url('pegawai/Files/private/files/' . $file->id) }}"
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
