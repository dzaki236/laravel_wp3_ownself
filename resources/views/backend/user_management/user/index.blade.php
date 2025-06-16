@extends('backend.layouts.master')
@section('title', $title)
@section('content')
    <div class="card text-start">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="zero_config">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User Data</th>
                            <th scope="col">Status</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item_user)
                            <tr class="">
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $item_user->name }} <br><small
                                        class="d-block text-muted">{{ $item_user->email }}</small></td>
                                        <td>{{ ucfirst($item_user->status) }}</td>
                                        <td>{{ ucfirst($item_user->role) }}</td>
                                <td>
                                    <form action="{{ route('backend.user.destroy', $item_user->id) }}"
                                        method="post" class="delete-form">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" class="btn btn-sm btn-danger text-white btn-delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <a href="{{ route('backend.user.edit', $item_user->id) }}"
                                            class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <br>
                                        <small>Apapun aksi yang dilakukan, akan berpengaruh pada transaksional
                                            user</small>
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
