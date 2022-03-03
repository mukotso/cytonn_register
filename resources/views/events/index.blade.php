@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
    <events :events="{{$events}}" :user="{{Auth()->user()}}"></events>
    </div>
@endsection
