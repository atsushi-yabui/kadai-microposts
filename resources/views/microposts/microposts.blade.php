@if (count($microposts) > 0)
    <ul class="list-unstyled">
        @foreach ($microposts as $micropost)
            <li class="media mb-3 shadow-sm p-3 mb-2 bg-light rounded">
                {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                <img class="mr-2 rounded-circle" src="{{ Gravatar::get($micropost->user->email, ['size' => 50]) }}" alt="">
                <div class="media-body">
                    <div>
                        {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                        {!! link_to_route('users.show', $micropost->user->name, ['user' => $micropost->user->id]) !!}
                        <span class="text-muted">{{__('top.postedat')}} {{ $micropost->created_at }}</span>
                    </div>
                    <div>
                        {{-- 投稿内容 --}}
                        <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>
                    </div>
                    <div>
                        {{-- フェイバリット／アンフェイバリットボタン --}}
                        @include('favorite.favorite_button')
                        @if (Auth::id() == $micropost->user_id)
                        
                            
                            
                            {{-- 投稿削除ボタンのフォーム --}}
                            {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
                                {!! Form::submit(__('top.Delete'), ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        @endif
                        <button onclick="$('#example-5').collapse('toggle')">{{__("top.Toggle")}}</button>
                        <div class="collapse" id="example-5">
                            <p>
                                {{-- コメントボタンのフォーム --}}
                                {!! Form::open(['route' => 'microposts.store']) !!}
                                    <div class="form-group">
                                        {!! Form::textarea('content',"@".nl2br(e($micropost->user->name))." 「".nl2br(e($micropost->content))." 」->", ['class' => 'form-control', 'rows' => '2']) !!}
                                        {!! Form::submit(__('top.Comment'), ['class' => 'btn btn-info btn-block']) !!}
                                    </div>
                                {!! Form::close() !!}
                            </p>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $microposts->links() }}
@endif