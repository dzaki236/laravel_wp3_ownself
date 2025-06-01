@extends('backend.layouts.master')
@section('title', $title)
@section('content')
{{ auth()->user() }}
@endsection
