@extends('Pegawai.layouts.index')

@section('container')
    @foreach ($pegawaiUsers as $pegawaiUser)
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List Attendence for {{ $pegawaiUser->name }}</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="{{ 'users-table-' . $pegawaiUser->id }}" width="100%"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th>Waktu Absensi</th>
                                <th>Tanggal Absensi</th>
                                <th>Status Absensi</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#{{ 'users-table-' . $pegawaiUser->id }}').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('get.recap.attendance.kasubag', ['userId' => $pegawaiUser->id]) }}",
                    columns: [{
                            data: 'attendences_time',
                            name: 'attendences_time'
                        },
                        {
                            data: 'attendences_date',
                            name: 'attendences_date'
                        },
                        {
                            data: 'attendance_status',
                            name: 'attendance_status'
                        },
                        {
                            data: 'attendences_Status',
                            name: 'attendences_Status'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, full, meta) {
                                return '<button onclick="acceptAttendance(' + full.id +
                                    ')" class="btn btn-success">Accept</button>' +
                                    '<button onclick="rejectAttendance(' + full.id +
                                    ')" class="btn btn-danger ml-2">Reject</button>';
                            }
                        },
                    ],
                });
            });

            function acceptAttendance(id) {
                $.ajax({
                    url: "{{ url('/kasubag/accept') }}/" + id,
                    type: 'GET', // Change to GET
                    dataType: 'json',
                    success: function(data) {
                        alert(data.message);
                        location.reload();
                        $('#users-table-' + id).DataTable().ajax.reload();
                        // You may need to reload or update the DataTable after accepting attendance
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            function rejectAttendance(id) {
                $.ajax({
                    url: "{{ url('/kasubag/reject') }}/" + id,
                    type: 'GET', // Change to GET
                    dataType: 'json',
                    success: function(data) {
                        alert(data.message);
                        location.reload();
                        $('#users-table-' + id).DataTable().ajax.reload();
                        // You may need to reload or update the DataTable after rejecting attendance
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        </script>
    @endforeach
@endsection
