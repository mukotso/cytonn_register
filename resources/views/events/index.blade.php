@extends('layouts.app')

@section('content')
    <events :events="{{$events}}" :user="{{Auth()->user()}}"></events>

@endsection
