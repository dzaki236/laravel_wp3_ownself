@extends('backend.layouts.master')
@section('title', $title)
@section('content')
    <div class="card text-start">
        <div class="card-body">
            <h4 class="card-title">Laporan Data Transaksi</h4>
            <form action="{{ route('backend.report.transaksi.generate') }}" method="get">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-4">
                        <div class="mb-3">
                            <label for="" class="form-label">Tanggal awal</label>
                            <input type="date" class="form-control" name="start_date" id="start_date"
                                aria-describedby="helpId" placeholder="" required />
                            <small id="helpId" class="form-text text-muted">Masukkan tanggal awal rekap</small>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4">
                        <div class="mb-3">
                            <label for="" class="form-label">Tanggal akhir</label>
                            <input type="date" class="form-control" name="end_date" id="end_date"
                                aria-describedby="helpId" placeholder="" required />
                            <small id="helpId" class="form-text text-muted">Masukkan tanggal akhir rekap</small>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 mt-4">
                        <input type="submit" name="type" class="btn btn-success" value="Csv">
                        <input type="submit" name="type" class="btn btn-light" value="Pdf">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
