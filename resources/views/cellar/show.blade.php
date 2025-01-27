@extends('layouts.app')
@section('title', 'Cellar Show')
@section('content')
<main class="flex-center flex-center height80">   
    <section class="structure">
        <header class="filter-wrapper just-between">
            <form action="" method="GET" class="search-container flex-col gap5 {{ !empty($query) ? 'expanded' : '' }}" id="search-form">
                <div class="flex just-between filter-box">
                    <div class="filter-order">
                        <label for="order">Tri :</label>
                        <select class="filter-item" id="type" name="order">
                            <option value="title" {{ $order === 'title' ? 'selected' : '' }}>Title</option>
                            <option value="country" {{ $order === 'country' ? 'selected' : '' }}>Country</option>
                            <option value="region" {{ $order === 'region' ? 'selected' : '' }}>Region</option>
                            <option value="color" {{ $order === 'color' ? 'selected' : '' }}>Color</option>
                        </select>
                    </div>
                    <div class="filter-options">
                        <div class="filter-item">
                            <p>Couleur :</p>
                            <div class="flex-al gap5">
                                @foreach ($colors as $option)
                                <label for="color">{{ $option }}</label>
                                <input type="checkbox" id="color" name="color" value="{{ $option }}" {{ $color === $option ? 'selected' : '' }}>
                                @endforeach
                            </div>
                        </div>
                        <div class="filter-item hidden">
                            <p>Pays :</p>
                            <div class="flex">
                                @foreach ($countries as $option)
                                <label for="country">{{ $option }}</label>
                                <input type="checkbox" id="country" name="country" value="{{ $option }}" {{ $color === $option ? 'selected' : '' }}>
                                @endforeach
                            </div>    
                        </div>
                    </div>
                </div>
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Recherche..." 
                    class="search-input"
                    value="{{ old('search', $query ?? '')}}"
                    id="search-input"
                >
                <button type="submit" class="search-btn" id="search-btn">
                    <i class="fas fa-search" id="search-icon"></i>
                </button>
            </form>
        </header>

        <!-- Actions principales du cellier -->
        <div class="btn-container-top">
            <a href="{{ route('cellar.edit', $cellar->id) }}" class="btn-border">Modifier</a>
            <a href="{{ route('cellar.add', $cellar->id) }}" class="btn-border">
                <i class="fa-solid fa-plus"></i> Ajouter une bouteille
            </a>
            <form method="POST" action="{{ route('cellar.destroy', $cellar->id) }}">
                @csrf
                @method('delete')
                <button type="submit" class="btn-border">Supprimer</button>
            </form>
        </div>    

        <!-- Afficher la quantité trouvée par défaut -->
        @if (empty($query) && empty($color) && empty($country) && empty($size))
            <div class="results">
                <h2>Vous avez <span>{{ $bottles->total() }} bouteilles</span> dans {{ $cellar->title }}</h2>
            </div>
        @endif

        <!--Afficher la quantité trouvée après la requête -->
        @if (!empty($query) || !empty($color) || !empty($country))
            <div class="results mb-10">
                @if (!empty($query))
                    <h2>Recherche de : "<span>{{ $query }}</span>"</h2>
                @endif
                @if (!empty($color) || !empty($country) || !empty($order))
                    <ul>Filtres:
                        @if (!empty($color)) <li>{{ $color }}</li>@endif
                        @if (!empty($color) && (!empty($country) )) @endif
                        @if (!empty($country)) <li>{{ $country }}</li>@endif
                        @if (!empty($country)) @endif
                    </ul>
                @endif
                <p><span>{{ $bottles->total() }}</span>@lang('lang.result_subtitle')</p>
            </div>
        @endif

        <section class="flex-col gap10">
            @foreach ($bottles as $bottle)
                <article class="card_bottle">
                    <picture>
                        <img src="{{ $bottle->image_src ?? asset('img/gallery/bottle_1.webp') }}" alt="{{ $bottle->title }}">
                    </picture>
                    <div class="card-body">
                        <div class="card-title">
                            <h2>{{ $bottle->title }}</h2>
                        </div>
                        <div class="card-category">
                            <p>{{ $bottle->color }}</p>
                            <div class="line"></div>
                            <p>{{ $bottle->size }}</p>
                            <div class="line"></div>
                            <p>{{ $bottle->country }}</p>
                        </div>
                        <div class="card-list">
                            @foreach ($cellar_bottles as $cellar_bottle)
                                @if ($cellar->id == $cellar_bottle->cellar_id && $bottle->id == $cellar_bottle->bottle_id)
                                    <p>@lang('lang.quantity') : {{ $cellar_bottle->quantity }}</p>
                                @endif
                            @endforeach
                        </div>
                        
                        <div class="btn-container">
                            <a href="{{ route('bottle.details', ['id' => $bottle->id]) }}" class="btn-border">@lang('lang.view')</a>
                            <a href="{{ route('cellar.remove', ['id' => $bottle->id, 'cellar_id' => $cellar->id]) }}" class="btn-border btn-remove">
                                <i class="fa-solid fa-minus"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </section>
    </section>
</main>

<script src="{{ asset('js/classes/SearchFormHandler.js') }}"></script>
@endsection