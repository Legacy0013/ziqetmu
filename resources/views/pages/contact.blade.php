@extends('layout.layout')

@section('content')
<div class="container-page">
    <h2>Contact</h2>

    <form action="{{ url('contact') }}" method="POST">
        @csrf




        
        <div class="ligne">
            <label class="block font-medium text-sm text-gray-700" for="nom">Entrez votre nom : </label>
            @error('nom')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" type="text" name="nom" id="nom" value="{{ old('nom') }}">
        </div>

        <div class="ligne">
            <label class="block font-medium text-sm text-gray-700" for="email">Entrez votre email : </label>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" type="email" name="email" id="email" value="{{ old('email') }}">
        </div>

        <div class="ligne">
            <label class="block font-medium text-sm text-gray-700" for="message">Entrez votre message : </label>
            @error('message')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <textarea class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" name="message" id="message">{{ old('message') }}</textarea>
        </div>

        
        <div class="flex-column">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-3 btn">
                Envoyer le message
            </button>
        </div>
    </form>
</div>
@endsection
