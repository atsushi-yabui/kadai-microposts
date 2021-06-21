@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <div class="row">
            <aside class="col-sm-4">
                {{-- ユーザ情報 --}}
                @include('users.card')
            </aside>
            <div class="col-sm-8">
                {{-- 投稿フォーム --}}
                @include('microposts.form')
                {{-- 投稿一覧 --}}
                @include('microposts.microposts')
                @include('commons.messages')
            </div>
        </div>
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>{{ __('messages.welcome') }}</h1>
                {{-- ユーザ登録ページへのリンク --}}
                {!! link_to_route('signup.get', __('password.Signupnow'), [], ['class' => 'btn btn-lg btn-primary']) !!}
                {!! link_to_route('login', __('password.login'), [], ['class' => 'btn btn-lg btn-info']) !!}
            </div>
        </div>
    @endif
@endsection