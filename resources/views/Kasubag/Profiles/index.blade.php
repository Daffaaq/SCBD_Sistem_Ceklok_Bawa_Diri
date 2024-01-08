@extends('Kasubag.layouts.index')

@section('container')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Profile</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6 col-1">
                                <!-- Name -->
                                <div class="form-group">
                                    <label for="name" style="color: black;">Name:</label>
                                    <input type="text" name="name" id="name" class="form-control form-control-sm"
                                        value="{{ $user->name }}" required readonly style="color: black;">
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label for="email" style="color: black;">Email:</label>
                                    <input type="email" name="email" id="email" class="form-control form-control-sm"
                                        value="{{ $user->email }}" required readonly style="color: black;">
                                </div>

                                <!-- Phone Number -->
                                <div class="form-group">
                                    <label for="no_telp" style="color: black;">Phone Number:</label>
                                    <input type="tel" name="no_telp" id="no_telp" class="form-control form-control-sm"
                                        value="{{ $user->no_telp }}" required readonly style="color: black;">
                                </div>
                            </div>

                            <div class="col-md-6 col-2">
                                <!-- Job Title -->
                                <div class="form-group">
                                    <label for="jabatan" style="color: black;">Job Title:</label>
                                    <input type="text" name="jabatan" id="jabatan" class="form-control form-control-sm"
                                        value="{{ $user->jabatan }}" required readonly style="color: black;">
                                </div>

                                <!-- Role -->
                                <div class="form-group">
                                    <label for="role_name" style="color: black;">Role:</label>
                                    <input type="text" name="role" id="role" class="form-control form-control-sm"
                                        value="{{ $user->role }}" required readonly style="color: black;">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <a href="{{ route('kasubag.dashboard') }}" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
