@extends('layout.layout')

@section('content')
    <div class="container-genres">
        <h2>Nos univers</h2>
        <h3>Genres</h3>

            <div class="wrap-cards">
                @foreach ($genres as $genre)
                <a href="{{ route('genre', $genre->id) }}">
                    <div class="card">
                        <div class="name">{{ $genre->name }}</div>
                    </div>
                </a>
                @endforeach
            </div>

    </div>
@endsection
