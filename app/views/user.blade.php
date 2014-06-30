@if(Session::has('message'))
    {{ Session::get('message')}}
@endif
<br>
@if (!empty($data))
    Hello, <strong>{{{ $data['name'] }}}</strong>
    <br>
    Your ID is {{ $data['userid']}}
    <br>
    <a href="logout">Logout</a>
@else
<div style="width:160px; margin:0 auto; text-align:center">
   <p><a href="login/fb"><img src="http://tweekly.fm/media/image/login-facebook.png"></a></p>
   <p><a href="login/twitter"><img src="https://dev.twitter.com/sites/default/files/images_documentation/sign-in-with-twitter-gray.png" alt="Sign in with Twitter"></a></p>
</div>
@endif