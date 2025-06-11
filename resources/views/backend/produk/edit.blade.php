@extends('backend.layouts.master')
@section('title', $title)
@section('content')
    <div class="card text-start">
        <div class="card-body">
            <form action="{{ route('backend.produk.update', $produk->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-5">
                        <img src="{{ $produk->url_foto_produk }}" alt="No img" class="w-50 mb-3">
                        <div class="mb-3">
                            <label for="foto_produk" class="form-label">Foto produk</label>
                            <div class="image-previewer"></div>
                            <input type="file" class="form-control" name="foto_produk" id="foto_produk"
                                placeholder="Masukkan foto produk" aria-describedby="fileHelpId" accept="image/*" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-7">
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Nama produk</label>
                            <input type="text" class="form-control" name="nama_produk" id="nama_produk"
                                aria-describedby="helpId" placeholder="Masukkan nama produk"
                                value="{{ old('nama_produk', $produk->nama_produk) }}" required />
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori Produk</label>
                            <select class="form-select" name="kategori" id="kategori" required>
                                <option selected disabled>Pilih kategori</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('kategori', $produk->kategori_id)==$item->id ? 'selected' : '' }}>
                                        {{ $item->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="detail" class="form-label">Detail produk</label>
                            <textarea class="form-control" name="detail" id="detail" rows="3" placeholder="Masukkan detail produk">{{ old('detail', $produk->detail) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga produk</label>
                            <input type="number" class="form-control" name="harga" id="harga"
                                aria-describedby="helpId" placeholder="Masukkan harga produk"
                                value="{{ old('harga', $produk->harga) }}" required />
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock produk</label>
                            <input type="number" class="form-control" name="stock" id="stock"
                                aria-describedby="helpId" placeholder="Masukkan stock produk"
                                value="{{ old('stock', $produk->stock) }}" required />
                        </div>
                        <div class="mb-3">
                            <label for="berat" class="form-label">Berat produk</label>
                            <input type="number" class="form-control" name="berat" id="berat"
                                aria-describedby="helpId" placeholder="Masukkan berat produk dalam satuan (gram)"
                                value="{{ old('berat', $produk->berat) }}" required />
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Status</label>
                            <select class="form-select" name="status" id="status" required>
                                <option selected disabled>Status</option>
                                <option value="active" {{ old('status', $produk->status) == 'active' ? 'selected' : '' }}>
                                    Active
                                </option>
                                <option value="archived"
                                    {{ old('status', $produk->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>

                </div>

            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Galery foto produk</h5>
            <div class="my-3">
                <label for="" class="form-label">Upload foto</label>
                <input type="file" class="form-control" name="galery_foto_produk" id="galery_foto_produk"
                    aria-describedby="helpId" placeholder="" />
                <small id="helpId" class="form-text text-muted">Help text</small>
            </div>

            <div class="table-responsive">
                <table class="table" id="zero_config">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produk->foto as $item_foto)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ $item_foto->url_foto_produk }}" alt="" class="w-25"></td>
                                <td>
                                    <form action="{{ route('backend.foto_produk.destroy', $item_foto->id) }}"
                                        method="post" class="delete-form">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" class="btn btn-sm btn-delete btn-danger text-white">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        CKEDITOR.replace('detail', {
            placeholder: 'Type your content here...'
        });
        $('#foto_produk').ijaboCropTool({
            preview: '.image-previewer',
            setRatio: 1,
            allowedExtensions: ['jpg', 'jpeg', 'png'],
            buttonsText: ['CROP', 'QUIT'],
            buttonsColor: ['#30bf7d', '#ee5155', -15],
            processUrl: '{{ route('backend.produk.update_foto_produk', $produk->id) }}',
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
        $('#galery_foto_produk').ijaboCropTool({
            preview: '.image-previewer',
            setRatio: 1,
            allowedExtensions: ['jpg', 'jpeg', 'png'],
            buttonsText: ['CROP', 'QUIT'],
            buttonsColor: ['#30bf7d', '#ee5155', -15],
            processUrl: '{{ route('backend.foto_produk.store', $produk->id) }}',
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
