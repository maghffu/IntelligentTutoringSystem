<html>
<head>
	<title>Quiz</title>
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
<script src="/bower_components/jquery.countdown/dist/jquery.countdown.js"></script>
</head>
<body class="grey lighten-4">
	<div class="row" style="margin-left:2%; margin-right:2%;">
		<div class="col s12">
			<h4>Quiz materi {{$judul}}</h4> 
			<table>
				<tr>
					<td width="2%"><i class="material-icons">access_time</i></td>
					<td><div id="clock"></div></td>
				</tr>
			</table>
			<hr>
			<form method="POST" action="{{url('mhs/quiz/selesai')}}" >
				{!!csrf_field()!!}
				<input type="text" name="id_log" hidden value="{{$id_log}}">
				<?php $index=1; ?>
				@foreach($soal as $s)
				<input type="text" name="kd[]" value="{{$s->kd_soal}}" hidden>
				<table class="table white" style="border: #f5f5f5 solid 1px;"> 
					<thead>
						<tr>
							<th width="4%">{{"No. ".$index}}</th>
							<th width="95%"> {!!$s->pertanyaan!!}</th>
						</tr>
					</thead>
					<tbody>

						<tr>
							<td>a. </td>
							<td>
								<input type="radio" class="with-gap" id="a{{$index}}" onclick="kirim_jawaban('a','{{$s->kd_soal}}')" value="a" name="jawaban{{$index}}" <?php echo ($s->jawaban== 'a')?"checked":"" ?> >
								<label for="a{{$index}}">{{$s->jawab_a}}</label>
							</td>
						</tr>
						<tr>
							<td>b. </td>
							<td>
								<input type="radio" class="with-gap" id="b{{$index}}" onclick="kirim_jawaban('b','{{$s->kd_soal}}')" value="b" name="jawaban{{$index}}" <?php echo ($s->jawaban== 'b')?"checked":"" ?> >
								<label for="b{{$index}}">{{$s->jawab_b}}</label>
							</td>
						</tr>
						<tr>
							<td>c. </td>
							<td>
								<input type="radio" class="with-gap" id="c{{$index}}" onclick="kirim_jawaban('c','{{$s->kd_soal}}')" value="c" name="jawaban{{$index}}" <?php echo ($s->jawaban== 'c')?"checked":"" ?> >
								<label for="c{{$index}}">{{$s->jawab_c}}</label>
							</td>
						</tr>
						<tr>
							<td>d. </td>
							<td>
								<input type="radio" class="with-gap" id="d{{$index}}" onclick="kirim_jawaban('d','{{$s->kd_soal}}')" value="d" name="jawaban{{$index}}" <?php echo ($s->jawaban== 'd')?"checked":"" ?> >
								<label for="d{{$index}}">{{$s->jawab_d}}</label>
							</td>
						</tr>
					</tbody>
					<?php $index++; ?>
				</table>
				<br>
				@endforeach
				<input class="btn btn-primary" type="button" value="submit" onclick="kirim()">
				<input type="submit" class="subm" hidden>
			</form>
		</div> 
	</div>

</body>

<script>
window.onunload = refreshParent;
function refreshParent() {
	window.opener.location.reload();
}

function kirim () {
	var resp = confirm("Yakin Ingin Submit?");
	if (resp) {
		$('.subm').trigger('click');
	}else{

	};
}

function kirim_jawaban (jwb,kd_soal) {
	$.ajax({
		url:"{{url('mhs/quiz/simpan_jawaban')}}"+"/"+jwb+"/"+kd_soal,
		success:function (data) {
			console.log(data);
		}
	});
}
//2016-01-06 22:10:12
$("#clock").countdown("{{$waktu}}", function(event) {
	$(this).text(
		event.strftime('Waktu mengerjakan kurang %M Menit, %S Detik')
		);
})
.on('finish.countdown', function(event) {
	$(this).parent().html('<strong>This offer has expired!</strong>');
});;
</script>
</html>