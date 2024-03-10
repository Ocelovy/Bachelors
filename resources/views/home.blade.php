@extends('layouts.app')

@section('background')
    <img src="{{ asset('.images/pozadie_index.jpg') }}" alt="pozadie_index" class="background-image">
@endsection

@section('content')

    <div class="container" id="notification">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card-header">{{ __('Oznámenie') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @auth
                            {{ __('Ste prihlásený! Vyberte si z ponuky.') }}
                        @else
                            {{ __('Musíte sa prihlásiť!') }}
                        @endauth
                    </div>
            </div>
        </div>
    </div>
    <div class="text-box">
        <h1>Nemocnica s poliklinikou</h1>
        <p>Prehľadná správa a manipulácia pacientov.</p>
        @if(auth()->check())
        <a class="hero-button" href="{{ route('pacient') }}">Spravuj pacientov</a>
        @endif
    </div>
@endsection
