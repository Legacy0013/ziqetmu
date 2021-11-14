@extends('layout.layout')

@section('content')
    <ul>
        @foreach ($titres as $titre)
            <li>{{str_pad($titre->order, 2, '0', STR_PAD_LEFT)}} - {{ $titre->name }}</li>
        @endforeach
    </ul>

    <h1>test</h1>
@endsection
