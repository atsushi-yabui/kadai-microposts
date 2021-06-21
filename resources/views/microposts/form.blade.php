{!! Form::open(['route' => 'microposts.store']) !!}
    <div class="form-group">
        {!! Form::textarea('content', NULL, ['class' => 'form-control', 'rows' => '2',"placeholder" => __("top.whatpost")]) !!}
        {!! Form::submit(__('top.Post'), ['class' => 'btn btn-primary btn-block']) !!}
    </div>
{!! Form::close() !!}