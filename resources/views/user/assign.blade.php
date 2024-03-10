@extends('layouts.app')

@section('background')
    <img src="{{ asset('.images/pozadie_index2.jpg') }}" alt="pozadie_index" class="background-image">
@endsection

@section('content')

    <form action="{{ route('users.assign', $user->id) }}" method="POST">
        @csrf
        <select name="ambulance_ids[]" multiple>
            @foreach($ambulances as $ambulance)
                <option value="{{ $ambulance->id }}">{{ $ambulance->name }}</option>
            @endforeach
        </select>
        <button type="submit" href="{{ route('users.assign', auth()->user()->getAuthIdentifier()) }}">Priradiť ambulancie</button>
    </form>
@endsection
