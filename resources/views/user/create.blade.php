@extends('layouts.app')

@section('background')
    <img src="{{ asset('.images/pozadie_index2.jpg') }}" alt="pozadie_index" class="background-image">
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
                <div class="container justify-content-center">
                <div class="card-header"><b>{{__('Pridať nového používateľa') }}</b></div>
                    @include('user.form')
                </div>
            </div>
    </div>
@endsection
