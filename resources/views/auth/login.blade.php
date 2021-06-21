@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>{{__('password.login') }}</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => 'login.post']) !!}
                <div class="form-group">
                    {!! Form::label('email', __('password.Email')) !!}
                    {!! Form::email('email', null, ['class' => 'form-control',"placeholder"=>__("password.Emailex")]) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', __('password.Password')) !!}
                    {!! Form::password('password', ['class' => 'form-control',"placeholder"=>__("password.Passwordex")]) !!}
                </div>

                {!! Form::submit(__('password.login'), ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}

            {{-- ユーザ登録ページへのリンク --}}
            <p class="mt-2">{{__('password.newuser')}} {!! link_to_route('signup.get', __('password.Signupnow')) !!}</p>
        </div>
    </div>
@endsection