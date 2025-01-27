@extends('layouts.app')
@section('title', 'Cellar Show')
@section('content')
<main class="flex-center flex-center height80">   
    <section class="structure">
        <h1 class="page-title">{{ $cellar->title }}</h1> 
        <header class="filter-wrapper just-between mb-10 pt-20 pb-20">
        

            <form action="" method="GET" class="search-container {{ !empty($query) ? 'expanded' : '' }}" id="search-form">
            <div class="filter-box">
            <i class="fa-solid fa-filter"></i>
            <div class="filter-options">
                <div class="filter-item">
                <label for="type">Type:</label>
                <select id="type" name="filter">
                    <option value="title">Title</option>
                    <option value="country">Country</option>
                    <option value="Region">Region</option>
                    <option value="color">Color</option>
                </select>
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

        <!-- Afficher la quantité trouvée par défaut -->
        @if (empty($query) && empty($color) && empty($country) && empty($size))
                <div class="results">
                    <h2>Vous avez <span>{{ $bottles->total() }} bouteilles</span></h2>
                    <p><span>Ajouter plus de bouteilles:</span></p>
                    <a href="{{ route('bottle.index') }}" class="btn-border">Ajouter</a>
                </div>
            @endif
             <!-- Afficher la quantité trouvée après le filtrage -->
             
        <!--Afficher la quantité trouvée après la requête -->
        @if (!empty($query) || !empty($color) || !empty($country) || !empty($size))
            <div class="results mb-10">
                @if (!empty($query))
                    <h2>Recherche de : "<span>{{ $query }}</span>"</h2>
                @endif
                @if (!empty($color) || !empty($country) || !empty($size))
                    <ul>Filtres:
                        @if (!empty($color)) <li>{{ $color }}</li>@endif
                        @if (!empty($color) && (!empty($country) || !empty($size))) @endif
                        @if (!empty($country)) <li>{{ $country }}</li>@endif
                        @if (!empty($country) && !empty($size)) @endif
                        @if (!empty($size)) <li>{{ $size }}</li>@endif
                    </ul>
                @endif
                <p><span>{{ $bottles->total() }}</span>@lang('lang.result_subtitle')</p>
            @else
                <!-- Display the default title -->
                <h2>Vous avez <span>{{ $bottles->total() }} bouteilles</span></h2>
            @endif

            @if (empty($query))
                <p><span>Ajouter Les Bouteilles:</span></p>
                <a href="{{ route('bottle.index') }}" class="btn-border">Ajouter</a>
            @endif
        </div>

        <section class="flex-col gap10">
            @if ($bottles->isEmpty())
            <div class="results">
                    @if (!empty($query))
                        <h2>Recherche de : "{{ $query }}"</h2>
                        <p><span>0</span> résultats trouvés</p>
                        <ul>
                            <li>Désolé, aucun résultat trouvé dans ce cellier.</li>
                            <li>Essayez une autre recherche</li>
                        </ul>
                        <a href="{{ route('cellar.show', ['cellar' => $cellar->id]) }}" class="btn-border">Retour au cellier</a>
                    @else
                        <p>Ce cellier est vide.</p>
                    @endif
                </div>
            @else
                      
            @foreach ($bottles as $bottle)
                <article class="card_bottle">
                    <picture>
                        <img src="{{ $bottle->image_src ?? asset('img/gallery/bottle_1.webp') }}" alt="{{ $bottle->title }}">
                    </picture>
                    <div class="card-body">
                        <div class="card-title">
                            <h2>
                                {{ $bottle->title }}
                            </h2>
                        </div>
                        <div class="card-category">
                            <p>{{ $bottle->color }}</p>
                            <div class="line"></div>
                            <p>{{ $bottle->size }}</p>
                            <div class="line"></div>
                            <p>{{ $bottle->country }}</p>
                        </div>
                       
                        
                            <div class="card-list flex flex-col gap5">
                            <p>@lang('lang.region') : {{ $bottle->region }}</p>
                            <p>@lang('lang.degree_alcohol') : {{ $bottle->degree_alcohol }}</p>
                            <p>@lang('lang.sugar_content') : {{ $bottle->sugar_content }}</p>
                            <p>@lang('lang.promoting_agent') {{ $bottle->promoting_agent }}</p>
                        
                        <p>@lang('lang.producer') : {{ $bottle->producer }}</p>
                        <p>@lang('lang.grape_variety') : {{ $bottle->grape_variety }}</p>
                        @foreach ($cellar_bottles as $cellar_bottle)
                        @if ($cellar->id == $cellar_bottle->cellar_id && $bottle->id == $cellar_bottle->bottle_id)
                            <div class="quantity">
                                @lang('lang.quantity') : {{ $cellar_bottle->quantity }}
                            </div>
                        @endif
                        @endforeach
                            </div>
                        <a href="{{ route('bottle.details', ['id' => $bottle->id]) }}" class="btn-border">@lang('lang.view')</a>
                    </div>
                </article>
            @endforeach
        </section>
    </section>
</main>

<script src="{{ asset('js/classes/SearchFormHandler.js') }}"></script>
    
@endsection
