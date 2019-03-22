<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ isset($title) ? $title : config('flow.title') }}</title>

    {!! Theme::css('css/cirrus.min.css') !!}
    {!! Theme::css('css/styles.css') !!}
    @stack('stylesheets')
</head>
<body>
    <div class="container">
        <div class="row">
            <a href="{{ url('/home') }}">{!! Theme::img('img/banner_w.png', 'banner', 'banner') !!}</a>
        </div>
        <div class="row">
            <div class="col-12">
                @if ($errors->any())
                    <div class="toast error">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session()->has('error_message'))
                    <div class="toast error">
                        {!! session('error_message') !!}
                        <button class="btn-close"></button>
                    </div>
                @endif
                @if(session()->has('success_message'))
                    <div class="toast success">
                        {!! session('success_message') !!}
                        <button class="btn-close"></button>
                    </div>
                @endif
            </div>
            <div class="col-3">
                <div id="loginbox" class="card text-center">
                    <div class="content">
                        <h6>@lang('menu.account')</h6>
                        <a class="btn btn-small btn-block" href="{{ url('/login') }}">@lang('menu.login')</a><div class="space-large"></div>
                        <div class="space"></div>
                        <a class="btn btn-small btn-block btn-primary" href="{{ url('/register') }}">@lang('menu.register')</a>
                    </div>
                </div>
                <div class="card text-center">
                    <h5>@lang('menu.mainmenu')</h5>
                    <a href="{{ url('/home') }}">@lang('menu.home')</a><div class="space-large"></div>

                    <h6>@lang('menu.information')</h6>
                    <hr>
                    <a href="{{ url('/') }}">@lang('menu.serverinfo')</a><div class="space"></div>
                    <a href="{{ url('/') }}">@lang('menu.castles')</a><div class="space"></div>
                    
                    <h6>@lang('menu.databases')</h6>
                    <hr>
                    <a href="{{ url('/') }}">@lang('menu.itemdb')</a><div class="space"></div>
                    <a href="{{ url('/') }}">@lang('menu.mobdb')</a><div class="space"></div>
                    @stack('sidebar')
                </div>
            </div>
            <div class="col-9">
                <div class="card">
                    <div class="content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6 offset-6 text-right">
                    <p class="credit">Powered by FlowCP ({{ \FlowCp\Flow::get_flow_version() }}) — Copyright &copy; 2019, Jittapan Pleumsumran.<br>FlowCP icon made by Freepik from www.flaticon.com</p>
                </div>
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>