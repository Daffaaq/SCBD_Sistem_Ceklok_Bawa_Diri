<!-- resources/views/Admin/Files/edit.blade.php -->

@extends('Admin.layouts.index')

@section('container')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit File</h6>
        </div>
        <div class="card-body">
            <form action="{{ url('superadmin/Files/update', $file->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Tambahkan formulir pengeditan sesuai kebutuhan -->
                <div class="form-group">
                    <label for="criteria_file">Kriteria File:</label>
                    <input type="text" name="criteria_file" class="form-control"
                        value="{{ old('criteria_file', $file->criteria_file) }}" required>
                </div>

                <div class="form-group">
                    <label for="file">File:</label>
                    <input type="file" name="file" class="form-control-file">
                </div>

                <div class="form-group">
                    <label for="target_type">Tujuan:</label>
                    <select name="target_type" class="form-control" required>
                        <option value="general" {{ old('target_type', $file->target_type) == 'general' ? 'selected' : '' }}>
                            Umum</option>
                        <option value="specific"
                            {{ old('target_type', $file->target_type) == 'specific' ? 'selected' : '' }}>Khusus</option>
                    </select>
                </div>

                <div class="form-group" id="specific_target"
                    style="{{ old('target_type', $file->target_type) == 'specific' ? '' : 'display: none;' }}">
                    <label for="target_id">Jabatan:</label>
                    <select name="target_id" class="form-control">
                        @foreach ($jabatans as $jabatan)
                            <option value="{{ $jabatan->jabatan }}"
                                {{ old('target_id', $file->target_id) == $jabatan->jabatan ? 'selected' : '' }}>
                                {{ $jabatan->jabatan }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!-- Tambahkan input lain sesuai kebutuhan -->
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
    <script>
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
                            if (data.redirect) {
                                window.location.href = data.redirect;
                            } else {
                                // Default redirect jika tidak ada data.redirect
                                window.location.reload();
                            }
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
