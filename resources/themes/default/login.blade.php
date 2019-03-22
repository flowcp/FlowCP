@extends('layout')

@section('content')
<h3>@lang('auth.login')</h3>
<p>@lang('auth.doyouhavenoaccount') <a href="{{ url('/register') }}">@lang('auth.letscreateone')</a></p>
<div class="divider"></div>
<div class="row">
    <div class="col-4">
        <form action="{{ url('/login') }}" method="POST">
            <div class="input-control">
                @lang('auth.youruserid') <input type="text" name="userid" id="userid">
            </div>
            <div class="input-control">
                @lang('auth.yourpassword') <input type="password" name="user_pass" id="user_pass">
            </div>
            {{ csrf_field() }}
            <div class="btn-container">
                <input type="submit" value="@lang('auth.login')">
            </div>
        </form>
    </div>
</div>
@endsection