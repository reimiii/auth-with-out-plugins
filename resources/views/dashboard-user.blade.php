@include('nav')

<h3>Dashboard User - Welcome to dashboard</h3>
<p>Hii {{ Auth::guard('web')->user()->name }}</p>
