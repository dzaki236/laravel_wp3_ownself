@extends('backend.layouts.master')
@section('title', $title)
@section('content')
    <div class="card text-start">
        <img class="card-img-top" src="holder.js/100px180/" alt="Title" />
        <div class="card-body">
            <h4 class="card-title">Laporan Data Produk</h4>
            {{-- <p class="card-text">Body</p> --}}
            <div class="row">
                <div class="col-12 col-sm-12 col-md-4">
                    <div class="mb-3">
                        <label for="" class="form-label">Tanggal awal</label>
                        <input type="text" class="form-control" name="" id="" aria-describedby="helpId"
                            placeholder="" />
                        <small id="helpId" class="form-text text-muted">Masukkan tanggal awal rekap</small>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4">
                    <div class="mb-3">
                        <label for="" class="form-label">Tanggal akhir</label>
                        <input type="text" class="form-control" name="" id="" aria-describedby="helpId"
                            placeholder="" />
                        <small id="helpId" class="form-text text-muted">Masukkan tanggal akhir rekap</small>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4"></div>
            </div>
        </div>
    </div>
@endsection
