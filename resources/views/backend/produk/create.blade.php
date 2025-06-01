@extends('backend.layouts.master')
@section('title', $title)
@section('content')
    <div class="card text-start">
        <div class="card-body">
            <form action="{{ route('backend.produk.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Nama produk</label>
                            <input type="text" class="form-control" name="nama_produk" id="nama_produk"
                                aria-describedby="helpId" placeholder="Masukkan nama produk"
                                value="{{ old('nama_produk', '') }}" required />
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori Produk</label>
                            <select class="form-select" name="kategori" id="kategori" required>
                                <option selected disabled>Pilih kategori</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="detail" class="form-label">Detail produk</label>
                            <textarea class="form-control" name="detail" id="detail" rows="3" placeholder="Masukkan detail produk">{{ old('detail', '') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga produk</label>
                            <input type="number" class="form-control" name="harga" id="harga"
                                aria-describedby="helpId" placeholder="Masukkan harga produk" value="{{ old('harga', '') }}"
                                required />
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock produk</label>
                            <input type="number" class="form-control" name="stock" id="stock"
                                aria-describedby="helpId" placeholder="Masukkan stock produk" value="{{ old('stock', '') }}"
                                required />
                        </div>
                        <div class="mb-3">
                            <label for="berat" class="form-label">Berat produk</label>
                            <input type="number" class="form-control" name="berat" id="berat"
                                aria-describedby="helpId" placeholder="Masukkan berat produk dalam satuan (gram)"
                                value="{{ old('berat', '') }}" required />
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Status</label>
                            <select class="form-select" name="status" id="status" required>
                                <option selected disabled>Status</option>
                                <option value="active">Active</option>
                                <option value="archived">Archived</option>
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
@endsection
@push('js')
    <script>
        CKEDITOR.replace('detail', {
            placeholder: 'Type your content here...'
        });
    </script>
@endpush
