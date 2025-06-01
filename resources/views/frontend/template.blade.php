@extends('frontend.layouts.master')
@section('title', $title)
@section('content')

@endsection
@push('js')
    <script src="{{ asset('frontend/js/main.js') }}"></script>
@endpush
@push('css')

@endpush
