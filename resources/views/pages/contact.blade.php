@extends('layout.layout')

@section('content')
<div class="container-page">
    <h2>Contact</h2>

    <form action="{{ url('contact') }}" method="POST">
        @csrf
        <div class="ligne">
            <label for="nom">Entrez votre nom : </label>
            <input type="text" name="nom" id="nom" value="{{ old('nom') }}">
            @error('nom')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="ligne">
            <label for="email">Entrez votre email : </label>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="ligne">
            <label for="message">Entrez votre message : </label>
            <textarea name="message" id="message">{{ old('message') }}</textarea>
            @error('message')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <input type="submit" value="Valider">
    </form>
</div>
@endsection
