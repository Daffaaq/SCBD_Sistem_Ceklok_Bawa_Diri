@extends('Admin.layouts.index')

@section('container')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">File Management</h6>
        </div>
        <div class="card-body">
            <!-- Form untuk mengunggah file -->
            <form action="{{ url('superadmin/Files/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="file">File:</label>
                    <input type="file" name="file" class="form-control-file" required>
                </div>
                <div class="form-group">
                    <label for="criteria_file">Kriteria File:</label>
                    <input type="text" name="criteria_file" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="criteria_file">Tujuan:</label>
                    <select name="target_type" class="form-control" required>
                        <option value="general">Umum</option>
                        <option value="specific">Khusus</option>
                    </select>
                </div>
                <div class="form-group" id="specific_target" style="display: none;">
                    <label for="specific_target">Jabatan:</label>
                    <select name="target_id" class="form-control">
                        @foreach ($jabatans as $jabatan)
                            <option value="{{ $jabatan->jabatan }}">{{ $jabatan->jabatan }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Upload File</button>
            </form>


            <!-- Tabel untuk menampilkan daftar file -->
            <div class="table-responsive mt-4">
                <table class="table table-bordered" id="files-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama File</th>
                            <th>Tanggal Upload</th>
                            <th>Waktu Upload</th>
                            <th>Tujuan</th>
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
        var fileDetailsUrl = "{{ url('superadmin/Files/private/files') }}"; // Update the URL
        $(document).ready(function() {
            $('#files-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('files.json') }}",
                columns: [{
                        data: 'name',
                        name: 'name',
                        render: function(data, type, row) {
                            return '<a href="' + fileDetailsUrl + '/' + row.id + '">' + data +
                                '</a>';
                        }
                    },
                    {
                        data: 'file_date_created',
                        name: 'file_date_created'
                    },
                    {
                        data: 'file_time_created',
                        name: 'file_time_created'
                    },
                    {
                        data: 'criteria_file',
                        name: 'criteria_file'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
            $('#files-table').on('click', '.file-link', function(e) {
                e.preventDefault();

                var fileId = $(this).data('id');

                // You might want to open the file in a new tab/window
                window.open(fileDetailsUrl + '/' + fileId);
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            var targetSelect = document.querySelector('select[name="target_type"]');
            var specificTargetDiv = document.getElementById('specific_target');

            targetSelect.addEventListener('change', function() {
                if (this.value === 'specific') {
                    specificTargetDiv.style.display = 'block';
                } else {
                    specificTargetDiv.style.display = 'none';
                }
            });

            // Menangani submit form secara asynchronous
            document.querySelector('form').addEventListener('submit', function(e) {
                e.preventDefault();

                var form = e.target;
                var formData = new FormData(form);

                fetch(form.action, {
                        method: 'POST',
                        body: formData,
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);

                        if (data.success) {
                            window.location.href = data.redirect;
                            // Jika sukses, reload tabel atau lakukan hal lain yang diinginkan
                            // Misalnya: document.querySelector('#users-table').DataTable().ajax.reload();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('File upload failed. Please try again.');
                    });
            });
        });
    </script>
@endsection
