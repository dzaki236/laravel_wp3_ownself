@extends('backend.layouts.master')
@section('title', $title)
@section('content')
<div class="card text-start">
    <div class="card-body">
        <div class="table-responsive">
            <a class="btn btn-primary mb-4" href="{{ route('backend.kategori.create') }}">Tambah kategori baru [+]</a>
            <table class="table" id="zero_config">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Kategori</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategori as $item_kategori)
                    <tr class="">
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $item_kategori->nama_kategori }}</td>
                        <td>
                            <form action="{{ route('backend.kategori.destroy', $item_kategori->id) }}" method="post"
                                class="delete-form">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="btn btn-sm btn-danger text-white btn-delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <a href="{{ route('backend.kategori.edit', $item_kategori->id) }}"
                                    class="btn btn-sm btn-info">
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
