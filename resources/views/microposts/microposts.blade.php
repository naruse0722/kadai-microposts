@if(count($microposts) > 0 ) 
    <ul class="list-unstyled">
        @foreach($microposts as $micropost)
            <li class="media mb-3">
                {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                <img src="{{ Gravatar::get($micropost->user->email, ['size' => 50]) }}" alt="" class="rounded mr-2">
                <div class="media-body">
                    <div>
                        {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                        {!! link_to_route('users.show', $micropost->user->name, ['user' => $micropost->user->id]) !!}
                        <span class="text-muted">posted at {{ $micropost->created_at }}</span>
                    </div>
                    <div class="mb-sm-2">
                        {{-- 投稿内容 --}}
                            {!! nl2br(e($micropost->content)) !!}
                    </div>
                    <div class="d-flex">
                            @include('microposts.favorite_button')

                        {{-- 投稿削除ボタンのフォーム --}}
                        @if(Auth::id() === $micropost->user_id) 
                            {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        @endif
                </div>
                </div>
            </li>
        @endforeach
    </ul>
        {{-- ページネーションのリンク --}}
        {{ $microposts->links() }}

@endif