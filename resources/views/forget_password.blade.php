@include('nav')
<h3>Forget Passwor Page</h3>

<form action="{{ route('forget.routeess') }}" method="POST">
  @csrf



  <div>
    Email Address
  </div>

  <div>
    <input type="email" name="email">
  </div>


  <div style="margin-top: 10px;">
    <input type="submit" value="Send">
    <br>
    <a href="{{ route('login') }}">Login??</a>
  </div>

</form>
