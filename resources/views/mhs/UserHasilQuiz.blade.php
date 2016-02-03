

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
#editor {
	width: 50%;
	height: 50%;
}
</style>
<script type="text/javascript" src="{{asset('js/materialize.js')}}"></script>
<body>
	<div class="row">
		<div class="container">
			<h5>Waktu Materi <?php echo $wm; ?></h5>
			<h5>Waktu Latihan <?php echo $wl; ?> </h5>
			<h5>Nilai <?php echo $nilai; ?> </h5>
			<h5>z <?php echo $z; ?></h5>
			<?php if ($z>=70): ?>
				<h4 class="green-text">Selamat anda telah menyelesaikan Materi <?php echo $judul->judul_materi ?></h4>
			<?php else: ?>
				<h4 class="red-text accent 3">Jangan menyerah, semangat belajar pada Bab 1</h4>
			<?php endif ?>
		<button class="btn btn-primary" onclick="tutup()">Materi</button>
		</div>

</div>
</body>
</html>

<script type="text/javascript">
	function tutup () {
		window.opener.location.href	= "<?php echo url('mhs/materi'); ?>";
		self.close();
	}
</script>
