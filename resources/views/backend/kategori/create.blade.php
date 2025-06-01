@extends('backend.layouts.master')
@section('title', $title)
@section('content')
    <div class="card text-start">
        <div class="card-body">
            <form action="{{ route('backend.kategori.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="nama_kategori" class="form-label">Nama kategori</label>
                    <input type="text" class="form-control" name="nama_kategori" id="nama_kategori"
                        aria-describedby="helpId" placeholder="Masukkan nama kategori"
                        value="{{ old('nama_kategori', '') }}" />
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
