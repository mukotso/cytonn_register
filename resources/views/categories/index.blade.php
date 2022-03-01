@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <category :categories="{{$categories}}"  :user="{{Auth()->user()}}">
        </category>
    </div>
@endsection
