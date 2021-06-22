@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            {{-- ユーザ情報 --}}
            @include('users.card')
            <a href = "{{ route('login', ['id' => $user->id]) }}" class="btn btn-primary btn-block" >
                {{__('top.MyTimeline')}}
            </a>
        </aside>
        <div class="col-sm-8">
            {{-- タブ --}}
            @include('users.navtabs')
            {{-- ユーザ一覧 --}}
            @include('microposts.microposts')
            {{-- @include('microposts.comment') --}}
        </div>
    </div>
@endsection