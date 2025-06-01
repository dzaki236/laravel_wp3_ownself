@extends('frontend.layouts.master')
@section('title', $title)
@section('content')
    {{-- {{ auth()->user() }} --}}
    <div class="m-5">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-2">
                <div class="list-group">
                    <a href="{{ route('my-profile.index') }}"
                        class="list-group-item list-group-item-action {{ $page == 'profile' ? 'active' : '' }}"
                        aria-current="true">
                        Profile Saya
                    </a>
                    <a href="{{ route('alamat.index') }}"
                        class="list-group-item list-group-item-action {{ $page == 'alamat' ? 'active' : '' }}">Alamat</a>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-10">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah alamat baru</h5>
                        <form action="{{ route('alamat.update', $alamat->id) }}') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-4">
                                <label for="nama_alamat">Nama / Judul Alamat</label>
                                <input type="text" name="nama_alamat" class="form-control" id="nama_alamat"
                                    placeholder="Masukkan nama / judul alamat" required
                                    value="{{ old('nama_alamat', $alamat->nama_alamat) }}">
                            </div>
                            <div class="form-group mb-4">
                                <label for="province" class="form-label">Provinsi</label>
                                <select class="form-select w-100 rich-select" name="province_id" id="province">
                                    <option selected disabled>Select one</option>
                                    @foreach ($province as $item_province)
                                        <option value="{{ $item_province->province_id }}"
                                            {{ $item_province->province_id == $alamat->province_id ? 'selected' : '' }}>
                                            {{ $item_province->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="kota" class="form-label">Kota</label>
                                <select class="form-select w-100 rich-select" name="city_id" id="city" required>
                                    {{-- <option selected disabled>Select one</option> --}}
                                    <option value="{{ $alamat->city_id }}" selected>{{ $alamat->city }}</option>
                                </select>
                            </div>

                            <div class="row mb-4">
                                <div class="col-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="nama_penerima">Nama Penerima</label>
                                        <input type="text" name="nama_penerima" class="form-control" id="nama_penerima"
                                            placeholder="Masukkan nama penerima" required
                                            value="{{ old('nama_penerima', $alamat->nama_penerima) }}">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="no_hp">Nomor Handphone Penerima</label>
                                        <input type="text" name="no_hp" class="form-control" id="no_hp"
                                            placeholder="Masukkan nomor handphone penerima" required
                                            value="{{ old('no_hp', $alamat->no_hp) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
                                <textarea class="form-control" name="alamat_lengkap" id="alamat_lengkap" rows="3"
                                    placeholder="Masukkan alamat lengkap (misal : jalan/blok, secara lengkap)" required>{{ old('alamat_lengkap', $alamat->alamat_lengkap) }}</textarea>
                            </div>
                            <div class="form-group mb-4">
                                <label for="kode_pos">Kode Pos</label>
                                <input type="text" name="kode_pos" class="form-control" id="kode_pos"
                                    placeholder="Masukkan kode pos" required
                                    value="{{ old('kode_pos', $alamat->kode_pos) }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('css')
    {{-- <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}" type="text/css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('js')
    {{-- <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.rich-select').select2();
            $("#province").on('change', function() {
                var province_id = $(this).val();
                $.ajax({
                    url: "{{ route('get_cities_origin') }}",
                    type: "GET",
                    data: {
                        province_id: province_id
                    },
                    success: function(response) {
                        // $("#kota").html(response);
                        html = '<option selected disabled>Select one</option>';
                        response.forEach(function(item) {
                            html += '<option value="' + item.city_id + '">' + item
                                .name +
                                '</option>';
                        });
                        $("#city").html(html);
                    }
                });
            });
        });
    </script>
@endpush
