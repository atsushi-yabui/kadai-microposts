
{{-- コメントボタンのフォーム --}}
{!! Form::open(['route' => ['user.comments', $micropost->id]]) !!}
    {!! Form::submit('top.Comment', ['class' => "btn btn-info btn-sm"]) !!}
{!! Form::close() !!}

