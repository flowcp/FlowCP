@extends('layout')

@section('content')
<h3>@lang('auth.register')</h3>
<p>@lang('auth.tosnotice')</p>
<div class="divider"></div>
<div class="row">
    <div class="col-12">
        <form action="{{ url('/register') }}" method="POST">
            <div class="input-control">
                <label for="userid">@lang('auth.youruserid')</label> <input type="text" name="userid" id="userid" autocomplete="off">
            </div>
            <div class="input-control">
                <label for="user_pass">@lang('auth.yourpassword')</label> <input type="password" name="user_pass" id="user_pass" autocomplete="off">
            </div>
            <div class="input-control">
                <label for="user_pass_confirmation">@lang('auth.yourpassword')</label> <input type="password" name="user_pass_confirmation" id="user_pass_confirmation" autocomplete="off">
            </div>
            <div class="input-control">
                <label for="email">@lang('auth.email')</label> <input type="email" name="email" id="email" autocomplete="off">
            </div>
            <div class="input-control">
                <label for="birthdate">@lang('auth.birthdate')</label> <input type="text" name="birthdate" id="birthdate" autocomplete="off">
            </div>
            <div class="row">
                <label>@lang('auth.gender')</label>
                <input type="radio" name="gender" value="M"> Male
                <input type="radio" name="gender" value="F"> Female
            </div>
            <div class="input-control">
                <input type="checkbox" name="agree"> <span>@lang('auth.agree') <a href="{{ url('/tos') }}">@lang('auth.tos')</a></span>
            </div>
            {{ csrf_field() }}
            <div class="btn-container">
                <input type="submit" value="@lang('auth.register')">
            </div>
        </form>
    </div>
</div>
@endsection