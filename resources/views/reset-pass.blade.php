@include('nav')
<h3>Reset Password Passwor Page</h3>

<form action="{{ route('newpass') }}" method="POST">
  @csrf
  <input type="hidden" name="token" value="{{ $token }}">
  <input type="hidden" name="email" value="{{ $email }}">
  <div>
    New Password
  </div>

  <div>
    <input type="password" name="new_password">
  </div>
  <div>
    Retype Password
  </div>

  <div>
    <input type="password" name="retype_password">

  </div>


  <div style="margin-top: 10px;">
    <input type="submit" value="Update">
  </div>

</form>
