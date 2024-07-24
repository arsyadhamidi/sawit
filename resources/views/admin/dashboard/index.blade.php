@extends('admin.layout.master')
@section('menuDashboard', 'active')
@section('content')
    @if (Auth()->user()->level_id == '1')
        @include('admin.index')
    @elseif (Auth()->user()->level_id == '2')
        @include('petani.index')
    @elseif (Auth()->user()->level_id == '3')
        @include('supir.index')
    @elseif (Auth()->user()->level_id == '5')
        @include('pemilik-usaha.index')
    @endif
@endsection
