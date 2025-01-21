@extends('layouts.app')
@section('title', 'Cellar Show')
@section('content')
            
<!---Composants pour le titre et la description de la page--->                
<!-- <x-header 
    title="{{ $cellar->title }}"
    subtitle="{!! $cellar->description !!}"
/> -->

<main class="flex-center flex-center height80">   
    <section class="structure">
        <h1 class="page-title">{{ $cellar->title }}</h1> 
        <div class="results">
            <h2>@lang('lang.result_title')</h2>
            <p><span>{{ $bottles->total() }}</span>@lang('lang.result_subtitle')</p>
            <p><span>Ajouter Les Bouteilles:</span></p>
            <a href="{{ route('bottle.index') }}" class="btn-border">Ajouter</a>
        </div>
        <section class="grid mt-20 mb-10">
            @if ($bottles->isEmpty())
                <p>Aucune bouteille disponible.</p>
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
        @endif
        </section>
    </section>
</main>

    
@endsection
