@extends('layouts.app')
@section('content')
    <show-event :event="{{$event}}" :user="{{Auth()->user()}}"></show-event>
@endsection
