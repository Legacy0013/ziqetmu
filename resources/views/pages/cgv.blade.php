@extends('layout.layout')

@section('content')
<main class="container container-page">
    <h2>Conditions Générales d'Utilisation</h2>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat amet explicabo fugit, iste dolor nesciunt dolores et quam mollitia obcaecati eligendi qui laborum totam eaque error eveniet possimus voluptate aspernatur?</p>
    @for ($i = 1; $i < 10; $i++)
        <h3>Partie <span>{{$i}}</span></h3>
        @for ($j = 1; $j < 3; $j++)
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat amet explicabo fugit, iste dolor nesciunt dolores et quam mollitia obcaecati eligendi qui laborum totam eaque error eveniet possimus voluptate aspernatur?</p>
        @endfor
    @endfor
</main>
@endsection
