@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <category :categories="{{$categories}}">
        </category>
    </div>
@endsection
