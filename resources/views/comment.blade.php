@extends('layouts.app')

@section('background')
    <img src="{{ asset('.images/pozadie_index3.jpg') }}" alt="pozadie_index" class="background-image">
@endsection

@section('content')
    <div class="container">
        <div class="comment-form-container">
            <form action="{{ route('comments.store') }}" method="POST" class="comment-form">
                @csrf
                <h1>Nástenka</h1>
                <label for="comment">Koment:</label>
                <textarea name="comment" required></textarea>
                <input class="form-check-input" type="checkbox" name="is_holiday" id="is_holiday" value="1">
                <label for="is_holiday">Týka sa dovolenky</label>
                <br>
                <button type="submit">Komentovať</button>
            </form>
        </div>
        <div class="comments-container">
            <div class="col-md-4">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="holidaySwitch" name="holiday" value="1" {{ request()->query('holiday') == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="holidaySwitch">Len dovolenky</label>
                </div>
                <form action="{{ route('comment') }}" method="GET" class="input-group">
                    <input type="text" name="search" class="form-control" id="comment-searchbar" placeholder="Vyhľadať komentár..." value="{{ request()->query('search') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-secondary">Vyhľadať</button>
                    </div>
                </form>
            </div>

            @foreach($comments as $comment)
                <div class="comment{{ $comment->is_holiday ? ' holiday-comment' : '' }}">
                    @if($comment->is_holiday)
                        <div class="holiday-indicator">!</div>
                    @endif
                    <p>{{ $comment->user ? $comment->user->name . ':' : 'Anonym' }} </p>
                    <p id="comment-content-{{ $comment->id }}">{{ $comment->comment }}</p>

                    @can('update', $comment)
                        <button class="edit-comment-btn" data-comment-id="{{ $comment->id }}">Upraviť</button>
                    @endcan

                    @can('delete', $comment)
                        <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="deleteCommentButton">Odstrániť</button>
                        </form>
                    @endcan
                        <small class="comment-time">{{ $comment->created_at->format('d.m.Y H:i ') }}</small>
                </div>
            @endforeach

        </div>
    </div>

@endsection
