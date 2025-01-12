@extends('layouts.app')
@section('title', 'Ajouter la bouteille')
@section('content')

<x-header 
    title="{{ __('lang.add_bottle') }}"
    subtitle="{{ __('lang.add_bottle_subtitle') }}"
/>
<main class="flex-center">
    <section class="structure flex-col-center height80">   
    <form class="form" action="{{ route('cellar.storeBottle') }}" method="POST">
        @csrf
        <div class="form-control">
            <label for="bottle_name">Nom de la Bouteille</label>
            <input type="text" name="bottle_name" value="{{ $bottle->title }}" readonly>
        </div>

        <div class="form-control">
            <label for="cellar_id">Choisir le Cellier</label>
            <select name="cellar_id" id="cellar_id" required>
                <option value="">Choisir le Nom</option>
                @foreach (Auth::user()->cellars as $cellar)
                    <option value="{{ $cellar->id }}">{{ $cellar->title }}</option>
                @endforeach
            </select>
        </div>

        <input type="hidden" name="bottle_id" value="{{ $bottle->id }}">

        <button type="submit" class="btn-border">Ajouter la bouteille</button>
    </form>


    </section>
</main>

@endsection