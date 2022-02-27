@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <users :users="{{$users}}">
        </users>
    </div>
@endsection
