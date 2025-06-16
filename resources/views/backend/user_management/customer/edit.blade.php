@extends('backend.layouts.master')
@section('title', $title)
@section('content')
    {{-- {{ auth()->user() }} --}}
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $title }}</h5>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6">
                    <img src="{{ $customer->url_foto_profile }}" alt="No img" class="w-50 mb-3">
                    <div class="mb-3">
                        <label for="foto_profile" class="form-label">Foto produk</label>
                        <div class="image-previewer"></div>
                        <input type="file" class="form-control" name="foto_profile" id="foto_profile"
                            placeholder="Masukkan foto profile" aria-describedby="fileHelpId" accept="image/*" />
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6">
                    <form action="{{ route('backend.profile.update') }}" method="post">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap </label>
                            <input type="text" class="form-control" name="name" id="name"
                                aria-describedby="helpId" placeholder="Masukkan nama lengkap"
                                value="{{ old('name', $customer->name) }}" required />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email </label>
                            <input type="email" class="form-control" name="email" id="email"
                                aria-describedby="helpId" placeholder="Masukkan alamat email"
                                value="{{ old('email', $customer->email) }}" required />
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor Handphone </label>
                            <input type="number" class="form-control" name="phone" id="phone"
                                aria-describedby="helpId" placeholder="Masukkan nomor handphone"
                                value="{{ old('phone', $customer->phone) }}" />
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password baru</label>
                            <input type="password" class="form-control" name="password" id="password"
                                aria-describedby="helpId" placeholder="Masukkan password baru" />
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password baru</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                id="password_confirmation" aria-describedby="helpId"
                                placeholder="Masukkan konfirmasi password baru" />
                        </div>
                        <input type="hidden" name="user_id" value="{{ $customer->id }}">
                        <div class="mb-3">
                            <label for="" class="form-label">Status</label>
                            <select class="form-select" name="status" id="status">
                                <option selected disabled>Select one</option>
                                <option value="aktif" {{ $customer->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="tidak_aktif" {{ $customer->status == 'tidak_aktif' ? 'selected' : '' }}>Tidak
                                    Aktif
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
@push('js')
    <script>
        $('#foto_profile').ijaboCropTool({
            preview: '.image-previewer',
            setRatio: 1,
            allowedExtensions: ['jpg', 'jpeg', 'png'],
            buttonsText: ['CROP', 'QUIT'],
            buttonsColor: ['#30bf7d', '#ee5155', -15],
            processUrl: '{{ route('backend.profile.update_foto_profile', $customer->id) }}',
            withCSRF: ['_token', '{{ csrf_token() }}'],
            onSuccess: function(message, element, status) {
                Swal.fire({
                    title: "Good job!",
                    text: "Success upload file!",
                    icon: "success"
                }).then(function() {
                    window.location.reload();
                });
            },
            onError: function(message, element, status) {
                Swal.fire({
                    title: "Error!",
                    text: "You have one error!",
                    icon: "error"
                }).then(function() {
                    window.location.reload();
                });
            }
        });
    </script>
@endpush
