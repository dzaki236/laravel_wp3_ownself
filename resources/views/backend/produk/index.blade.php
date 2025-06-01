@extends('backend.layouts.master')
@section('title', $title)
@section('content')
    <div class="card text-start">
        <div class="card-body">
            <div class="table-responsive">
                <a class="btn btn-primary mb-4" href="{{ route('backend.produk.create') }}">Tambah kategori baru [+]</a>
                <table class="table" id="zero_config">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Harga Produk</th>
                            <th scope="col">Status Produk</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produk as $item)
                            <tr class="">
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_produk }}</td>
                                <td>{{ format_rupiah($item->harga) }}</td>
                                <td>{{ strtoupper($item->status) }}</td>
                                <td>
                                    <form action="{{ route('backend.produk.destroy', $item->id) }}" method="post"
                                        class="delete-form">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" class="btn btn-sm btn-delete btn-danger text-white">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <a href="{{ route('backend.produk.edit', $item->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
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
