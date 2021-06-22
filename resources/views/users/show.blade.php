@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            {{-- ユーザ情報 --}}
            @include('users.card')
            @if (Auth::id() == $user->id)
            <a href = "{{ route('login', ['id' => $user->id]) }}" class="btn btn-primary btn-block" >
                {{__('top.MyTimeline')}}
            </a>
            @endif
        </aside>
        <div class="col-sm-8">
            {{-- タブ --}}
            @include('users.navtabs')
            @if (Auth::id() == $user->id)
                {{-- 投稿フォーム --}}
                @include('microposts.form')
            @endif
            {{-- 投稿一覧 --}}
            @include('microposts.microposts')
            @include('commons.messages')
            
        </div>
        
        
        
        
        
    </div>
@endsection

