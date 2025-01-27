@extends('layouts.app')
@section('title', 'Edit cellar')
@section('content')
<main class="flex-center">
    <section class="structure flex-col-center height80">   
        <form class="form" method="POST">
            @csrf
            @method('put')
            <div class="form-control">
                <label for="title">@lang('lang.cellar_name')</label>
                <input type="text" name="title" value="{{ old('title', $cellar->title) }}" placeholder="Entrez le nom...">
                @if ($errors->has('title'))
                    <div class="alert_msg">
                        {{$errors->first('title')}}
                    </div>
                @endif
            </div>
            <div class="form-control">
                <label for="description">@lang('lang.cellar_desc')</label>
                <textarea name="description" placeholder="Description de ce cellier....">{{ old('description', $cellar->description) }}</textarea>
                @if ($errors->has('description'))
                    <div class="alert_msg">
                        {{$errors->first('description')}}
                    </div>
                @endif
            </div>
            <button type="submit" class="btn-border">@lang('lang.cellar_create')</button>
        </form>
    </section>
</main>

@endsection
