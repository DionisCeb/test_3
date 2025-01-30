@extends('layouts.app')
@section('title', 'User Profile')
@section('content')

<!--
    TODO: UX/UI
    TODO: if cellars->isEmpty()
-->

<main class="flex-center height60">
    <section class="structure flex-col gap10">
        <div class="section-title">
            <h1>Mon profil</h1>
        </div>
        <!-- <div class="line"></div>  -->
        <div class="info-details profile">
            <div class="info-grid mb-5">
                <div class="info-item">
                    <span class="info-label">@lang('lang.user_name') :</span>
                    <span class="info-value">{{ $user->name }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">@lang('lang.email') :</span>
                    <span class="info-value">{{ $user->email }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">@lang('lang.created') :</span>
                    <span class="info-value">{{ $user->created_at->format('d/m/y') }}</span>
                </div>
                <!-- <div class="info-item hidden">
                    <span class="info-label">Derniere mise a jour :</span>
                    <span class="info-value">{{ $user->updated_at }}</span>
                </div> -->
            </div>
            <div class="btn-container flex-center gap5">
            <a href="{{ route('user.edit', $user->id) }}" class="btn-icon btn-edit flex-al just-between">modifier<i class="fa-solid fa-pen-to-square"></i></a>
            <!-- <a href="{{ route('user.show', Auth::id()) }}"><i class="fa-solid fa-address-card"></i>Profil</a> -->

            </div>
        </div>

        <div class="line"></div> 
        <!-- cellars -->
        @if($cellars)
            <section class="flex-col gap10">
                @if($count)
                <div class="flex-center">
                    <h2>Nombres de Celliers : {{ $count }}</h2>
                </div>
                @endif
                <div class="info-details profile-cellar">
                @foreach ($cellars as $cellar)
                <div class="info-grid mb-5">
                    <div class="info-item">
                        <span class="info-label">Titre : </span>
                        <span class="info-value">{{ $cellar->title }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Description : </span>
                        <span class="info-value">{{ $cellar->description }}</span>
                    </div>
                </div>
                <div class="btn-container flex-center gap5 mb-5">
                    <a href="{{ route('cellar.edit', $cellar->id) }}" class="btn-icon btn-edit flex-al just-between">modifier<i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="{{ route('cellar.show', $cellar->id) }}" class="btn-icon btn-show flex-al just-between">voir<i class="fa-solid fa-eye"></i></a>
                    
                </div> 
                <!-- <div class="line"></div> -->
                @endforeach
                </div>
            </section>

            @endif
            @auth('web')
            <div class="btn-container flex-center">
                <button class="btn-icon btn-remove flex-al just-between" id="delete-btn">@lang('lang.logout')
                    <i class="fa-solid fa-right-from-bracket"></i>
                </button>
                <div class="popup-overlay hide" id="popup-overlay">
                    <div class="popup-delete">
                        <div class="message">
                            <h2>Êtes-vous sûr de vouloir vous déconnecter ?</h2>
                        </div>
                        <div class="confirm-buttons">
                            <button id="cancel-btn">Annuler <i class="fa-solid fa-ban"></i></button>
                            <a href="{{ route('logout') }}" class="btn-icon btn-remove flex-al just-between">@lang('lang.logout')
                                <i class="fa-solid fa-right-from-bracket"></i>
                            </a>
                        </div>
                    </div>
                </div>


            </div>
            
            @endauth


</section>
</main>

<script src="{{ asset('js/classes/ConfirmationModal.js') }}"></script>

@endsection