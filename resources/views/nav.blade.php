<a href="{{ route('home') }}">Home</a> -

@if(Auth::guard('web')->user())
<a href="{{ route('dsh_user') }}">Dashboard</a> -
<a href="{{ route('logout') }}">Logout</a>
@endif


@if(!Auth::guard('web')->user())
<a href="{{ route('login') }}">Login</a> -
<a href="{{ route('register') }}">Register</a>
@endif
