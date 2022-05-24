@include('admin.nav')

<h3>Dashboard Admin - Welcome to dashboard</h3>
<p>Hii {{ Auth::guard('admin')->user()->name }}</p>
