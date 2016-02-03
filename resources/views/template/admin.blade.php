
<html>
<head>
	<title>Intelligent Tutoring Systems</title>
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
<script type="text/javascript" src="{{asset('js/jquery-2.1.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/materialize.js')}}"></script>
<script type="text/javascript" src="{{asset('tinymce/js/tinymce/tinymce.min.js')}}"></script>
<body class="grey lighten-4">
		
	<div class="navbar-fixed">
		<nav>
			<div class="nav-wrapper red darken-4">
				<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
				<a href="#" class="brand-logo center">Administrator</a>
				<ul id="nav-mobile" class="left hide-on-med-and-down">
					<li @yield('Beranda') ><a href="{{url('home')}}"><i class="material-icons">home</i></a></li>
					<li @yield('Materi') ><a href="{{url('materi')}}">Materi</a></li>
					<li @yield('Soal') ><a href="{{url('latihan')}}">Latihan</a></li>
					<li @yield('Soal') ><a href="{{url('soal')}}">Soal</a></li>
					<li @yield('Pengguna') ><a href="{{url('user')}}">Pengguna</a></li>
				</ul>
				<ul id="nav-mobile" class="right hide-on-med-and-down	">
					<li><a class="dropdown-button1" href="#!" data-activates="dropdown1">{{$nama_user}}<i class="material-icons right">arrow_drop_down</i></a></li>
				</ul>
				<ul id="dropdown1" class="dropdown-content">
					<li></li>
					<li><a href="#!">Pengaturan</a></li>
					<li><a href=" {{url('auth/logout')}} ">Keluar</a></li>
				</ul>
				
				 <ul class="side-nav" id="mobile-demo">
				 	<a href="#" class="center">{{$nama_user}}</a>
				 	 <li><hr></li>
				 	<li class="active"><a href="{{url('home')}}">Beranda</a></li>
					<li><a href="{{url('materi')}}">Materi</a></li>
					<li><a href="{{url('soal')}}">Latihan</a></li>
					<li><a href="{{url('soal')}}">Soal</a></li>
					<li><a href="{{url('user')}}">Pengguna</a></li>
					<li><a href="#!">Pengaturan</a></li>
					<li><a href=" {{url('auth/logout')}} ">Keluar</a></li>
				 </ul>

			</div>
		</nav>
	</div>
	<div class="container z-depth-2 white">
	@yield('konten')
	</div>
</body>

<script>
  tinymce.init({
    selector: '#isi',
    theme: 'modern',
    height: 300,
     plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'save table contextmenu directionality emoticons template paste textcolor'
    ],
  });
  </script>
<script type="text/javascript">
$(document).ready(function () {
	$(".dropdown-button1").dropdown();
	$(".dropdown-button").dropdown();
	$(".button-collapse").sideNav();
	$('.tooltipped').tooltip({delay: 50});
	$('select').material_select();
});
</script>
</html>
