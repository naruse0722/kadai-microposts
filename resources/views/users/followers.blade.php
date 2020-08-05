@extends('layouts.app')
@section('content')
    <div class="row">
        <aside class="col-sm-4">
            {{-- user information --}}
            @include('users.card')
        </aside>
        <div class="col-sm-8">
            {{-- tab --}}
            @include('users.navtabs')
            {{-- user catalog --}}
            @include('users.users')
        </div>
    </div>
@endsection