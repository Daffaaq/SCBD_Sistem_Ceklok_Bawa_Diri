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
    <div class="modal fade" id="editFileModal" tabindex="-1" role="dialog" aria-labelledby="editFileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFileModalLabel">Edit File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editFileForm" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="edit_criteria_file">Kriteria File:</label>
                            <input type="text" id="edit_criteria_file" name="criteria_file" class="form-control"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="edit_file">File:</label>
                            <input type="file" id="edit_file" name="file" class="form-control-file">
                        </div>
                        <div class="form-group">
                            <label for="criteria_file">Tujuan:</label>
                            <select name="target_type" class="form-control" required>
                                <option value="general">Umum</option>
                                <option value="specific">Khusus</option>
                            </select>
                        </div>
                        <div class="form-group specific-target-modal" style="display: none;">
                            <label for="specific_target">Jabatan:</label>
                            <select name="target_id" class="form-control">
                                @foreach ($jabatans as $jabatan)
                                    <option value="{{ $jabatan->jabatan }}">{{ $jabatan->jabatan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Tambahkan input lain sesuai kebutuhan -->
                        <input type="hidden" id="edit_file_id" name="file_id">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
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
                        searchable: false,
                        render: function(data, type, row) {
                            return '<button class="btn btn-sm btn-danger delete-file" data-id="' +
                                row.id + '">Delete</button>' +
                                ' <button class="btn btn-sm btn-primary edit-file" data-id="' +
                                row.id + '">Edit</button>';
                        }
                    },
                ]
            });
            $('#files-table').on('click', '.file-link', function(e) {
                e.preventDefault();

                var fileId = $(this).data('id');

                // You might want to open the file in a new tab/window
                window.open(fileDetailsUrl + '/' + fileId);
            });
            // Tambahkan script untuk menangani klik tombol Edit
            $('#files-table').on('click', '.edit-file', function(e) {
                e.preventDefault();
                var fileId = $(this).data('id');

                // Arahkan pengguna ke halaman edit
                window.location.href = "{{ url('/superadmin/Files/edit') }}" + '/' + fileId;
            });
        });

        $('#files-table').on('click', '.delete-file', function() {
            var fileId = $(this).data('id');

            if (confirm('Apakah Anda yakin ingin menghapus file ini?')) {
                // Ambil token CSRF dari meta tag
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                // Kirim permintaan penghapusan ke server
                $.ajax({
                    url: fileDetailsUrl + '/delete/' + fileId,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Sertakan token CSRF dalam header
                    },
                    success: function(data) {
                        alert(data.message);

                        if (data.success) {
                            // Muat ulang tabel setelah penghapusan berhasil
                            $('#files-table').DataTable().ajax.reload();
                        }
                    },
                    error: function(error) {
                        console.error('Error:', error);
                        alert('File deletion failed. Please try again.');
                    }
                });
            }
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
