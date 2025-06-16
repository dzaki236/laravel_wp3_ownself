@extends('backend.layouts.master')
@section('title', $title)
@section('content')
    {{-- {{ auth()->user() }} --}}
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $title }}</h5>
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('backend.user.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap </label>
                            <input type="text" class="form-control" name="name" id="name"
                                aria-describedby="helpId" placeholder="Masukkan nama lengkap" value="{{ old('name', '') }}"
                                required />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email </label>
                            <input type="email" class="form-control" name="email" id="email"
                                aria-describedby="helpId" placeholder="Masukkan alamat email" value="{{ old('email', '') }}"
                                required />
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor Handphone </label>
                            <input type="number" class="form-control" name="phone" id="phone"
                                aria-describedby="helpId" placeholder="Masukkan nomor handphone"
                                value="{{ old('phone', '') }}" />
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password baru</label>
                            <input type="password" class="form-control" name="password" id="password"
                                aria-describedby="helpId" placeholder="Masukkan password baru" required/>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password baru</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                id="password_confirmation" aria-describedby="helpId"
                                placeholder="Masukkan konfirmasi password baru" required/>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Status</label>
                            <select class="form-select" name="status" id="status" required>
                                <option selected disabled>Select one</option>
                                <option value="aktif" {{ old('status', '') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="tidak_aktif" {{ old('status', '') == 'tidak_aktif' ? 'selected' : '' }}>Tidak
                                    Aktif
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Role</label>
                            <select class="form-select" name="role" id="role" required>
                                <option selected disabled>Select one</option>
                                <option value="admin" {{ old('role', '') == 'admin' ? 'selected' : '' }}>Admin
                                </option>
                                <option value="super_admin" {{ old('role', '') == 'super_admin' ? 'selected' : '' }}>Super
                                    Admin
                                </option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
