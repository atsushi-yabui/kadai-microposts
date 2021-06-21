@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>{{__('password.Signup')}}</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => 'signup.post']) !!}
                <div class="form-group">
                    {!! Form::label('name', __('password.Name')) !!}
                    {!! Form::text('name', null, ['class' => 'form-control',"placeholder"=>__("password.Nameex")]) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', __('password.Email')) !!}
                    {!! Form::email('email', null, ['class' => 'form-control',"placeholder"=>__("password.Emailex")]) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', __('password.Password')) !!}
                    {!! Form::password('password', ['class' => 'form-control',"placeholder"=>__("password.Passwordex")]) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', __('password.Confirmation')) !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control',"placeholder"=>__("password.Confirmationex")]) !!}
                </div>

                {!! Form::submit(__('password.Signup'), ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection