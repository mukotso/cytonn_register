@extends('layouts.app')

@section('content')
    <user-profile :user="{{$userDetails}}"></user-profile>

@endsection
