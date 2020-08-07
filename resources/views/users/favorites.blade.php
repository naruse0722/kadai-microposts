@extends('layouts.app')
@section('content')
    <div class="row">
        <aside class="col-sm-4">
            {{-- user information --}}
            @include('users.card')
        </aside>
        <div class="col-sm-8">
            <div class="col-sm-8">
            {{-- tab --}}
                @include('users.navtabs')
            {{-- favorite catalog --}}
            @if(count($microposts) > 0)
            <ul class="list-unstyled">
                @foreach($microposts as $micropost)
                   <li class="media">
                        {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
                        <img class="mr-2 rounded" src="{{ Gravatar::get($user->email, ['size' => 50]) }}" alt="">
                        <div class="media-body">
                            <div>
                                {{ $user->name }}
                                <span class="text-muted">{{ $micropost->created_at }}</span>
                            </div>
                            <div>
                                {!! nl2br(e($micropost->content)) !!}
                                @include('microposts.favorite_button')
                            </div>
                        </div>
                    </li>
                @endforeach
                </ul>
            @endif
        </div>
        </div>
    </div>
@endsection