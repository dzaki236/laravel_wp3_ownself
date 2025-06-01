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
                        <h5 class="card-title">Daftar Alamat Saya</h5>
                        <div class="table-responsive">
                            <a href="{{ route('alamat.create') }}" class="btn btn-warning mb-4">Tambah alamat baru</a>
                            <table class="table" id="zero_config">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alamat as $item_alamat)
                                        <tr class="">
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>{{ $item_alamat->nama_alamat }}</td>
                                            <td>
                                                <form action="{{ route('alamat.destroy', $item_alamat->id) }}"
                                                    method="post" class="delete-form">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="button"
                                                        class="btn btn-sm btn-danger text-white btn-delete">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <a href="{{ route('alamat.edit', $item_alamat->id) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="fa fa-pencil"></i>
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
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}" type="text/css">
@endpush
@push('js')
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
@endpush
