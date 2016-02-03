<link rel="stylesheet" type="text/css" href="{{asset('css/materialize.css')}}" media="screen,projection">
</head>
<style type="text/css">
@font-face {
    font-family: 'Material Icons';
    font-style: normal;
    font-weight: 400;
    src: local('Material Icons'), local('MaterialIcons-Regular'), url({{asset('css/2fcrYFNaTjcS6g4U3t-Y5ZjZjT5FdEJ140U2DJYC3mY.woff2')}}) format('woff2');
}

.material-icons {
    font-family: 'Material Icons';
    font-weight: normal;
    font-style: normal;
    font-size: 24px;
    line-height: 1;
    letter-spacing: normal;
    text-transform: none;
    display: inline-block;
    white-space: nowrap;
    word-wrap: normal;
    direction: ltr;
    -webkit-font-feature-settings: 'liga';
    -webkit-font-smoothing: antialiased;
}
</style>
<!-- resources/views/auth/login.blade.php -->
<body class="grey lighten-4">

    <div class="container">
        <div class="row">
            <div class="col m12 s12">&nbsp;</div>
            <div class="col m12 s12">&nbsp;</div>
            <div class="col m6 s12 push-m3 z-depth-2">
                <h5><i class="material-icons">vpn_key</i>Form Login </h5>
                <hr>
                <form method="POST" action="/auth/login">
                    {!! csrf_field() !!}

                    <div class="input-field col s12">
                       <i class="material-icons prefix">account_circle</i>
                       <input id="username" type="text" class="validate" name="username" value="{{ old('username') }}">
                       <label for="username">Username</label>
                   </div>

                   <div class="input-field col s12">
                    <i class="material-icons prefix">fingerprint</i>
                    <input id="password" type="password" class="validate" name="password" >
                    <label for="password">Password</label>
                </div>

                <div class="input-field col s12">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember"> Remember Me</label>
                </div>

                <div class="input-field col s12">
                    <button type="submit" class="btn waves-effect waves-ligh">Login <i class="material-icons right">send</i></button>
                    <a href="{{url('auth/register')}}">
                        <button type="button" class="btn orange accent-3 waves-effect waves-ligh ">Daftar <i class="material-icons">accessible</i></button>
                    </a>
                </div>
                <div class="input-field col s12">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
<script type="text/javascript" src="{{asset('js/jquery-2.1.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/materialize.js')}}"></script>
<script type="text/javascript">
$(document).ready(function () {
    $(".dropdown-button").dropdown();
    @if ($errors->has('username'))
    Materialize.toast('Username Atau Password salah', 3000, 'rounded') 
    @endif

    @if ($errors->has('notactive'))
    Materialize.toast('Username Belum aktif, hubungi admin', 3000, 'rounded') 
    @endif

    @if (session('status'))
    Materialize.toast('Selamat anda telah terdaftar', 3000, 'rounded') 
    @endif

});
</script>
</html>
