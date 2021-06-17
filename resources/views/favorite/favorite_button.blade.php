
@if (Auth::user()->is_favoriting($micropost->id))
    {{-- アンフォローボタンのフォーム --}}
    {!! Form::open(['route' => ['favorites.unfavorite', $micropost->id], 'method' => 'delete']) !!}
        {!! Form::submit(__('top.UnFavorite'), ['class' => "btn btn-success btn-sm"]) !!}
    {!! Form::close() !!}
@else
    {{-- フォローボタンのフォーム --}}
    {!! Form::open(['route' => ['favorites.favorite', $micropost->id]]) !!}
        {!! Form::submit(__('top.Favorite'), ['class' => "btn btn-default btn-sm"]) !!}
    {!! Form::close() !!}
@endif

