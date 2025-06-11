<div class="px-4">

    @if ($errors->any())
        <div class="my-4">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    @if (Session::has('error'))
        <div class="my-4">
            <div class="alert alert-danger" role="alert">
                <strong>Error!</strong> {{ session('error') }}
            </div>
        </div>
    @endif
    @if (Session::has('success'))
        <div class="my-4">
            <div class="alert alert-success" role="alert">
                <strong>Success!</strong> {{ session('success') }}
            </div>
        </div>
    @endif
</div>
