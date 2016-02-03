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

<body class="grey lighten-4">

  <div class="container">
    <div class="row">
      <div class="col m12 s12">&nbsp;</div>
      <div class="col m12 s12">&nbsp;</div>
      <div class="col m6 s12 push-m3 z-depth-2">
        <h5><i class="material-icons">assignment_ind</i>Form Pendaftaran </h5>
        <hr>
        <form method="POST" action="{{url('auth/register')}}">
          {!! csrf_field() !!}

          <div class="input-field col s12">
           <input id="nim" type="text" class="validate" name="nim" value="{{ old('nim') }}">
           <label for="nim">NIM</label>
         </div>

         <div class="input-field col s12">
           <input id="namal" type="text" class="validate" name="nama_lengkap" value="{{ old('nama_lengkap') }}">
           <label for="namal">Nama Lengkap</label>
         </div>
         <div class="input-field col s12">
           <textarea id="alamat" type="text" class="materialize-textarea" rows="4" cols="50" name="alamat">
            {{ old('alamat') }}
          </textarea>
          <label for="alamat">Alamat</label>
        </div>

        <div class="input-field col s12">
         <input id="username" type="text" class="validate" name="username" value="{{ old('username') }}">
         <label for="username">Username</label>
       </div>
       <div class="input-field col s12">
         <input id="pass1" type="password" class="validate" name="password" >
         <label for="pass1">Password</label>
       </div>
       <div class="input-field col s12">
         <input id="pass2" type="password" class="validate" name="confirm">
         <label for="pass2">ketik ulang pass</label>
       </div>


       <div class="input-field col s12">
        <button type="submit" class="btn waves-effect waves-ligh">Daftar <i class="material-icons right">send</i></button>
        <a href="{{url('auth/login')}}">
          <button type="button" class="btn red accent-3 waves-effect waves-ligh ">Batal</button>
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

  @if ($errors->has('nim'))
  Materialize.toast('Nim Tidak sesuai kriteria', 3000, 'rounded') 
  @endif

  @if ($errors->has('nama_lengkap'))
  Materialize.toast('Nama Tidak Boleh kosong', 3000, 'rounded') 
  @endif

  @if ($errors->has('username'))
  Materialize.toast('Username Tidak Boleh kosong', 3000, 'rounded') 
  @endif

  @if ($errors->has('password'))
  Materialize.toast('Password salah atau tidak sesuai kriteria', 3000, 'rounded') 
  @endif

  @if (session('status'))
  Materialize.toast('Selamat anda telah terdaftar', 3000, 'rounded') 
  @endif


});
</script>

</html>
