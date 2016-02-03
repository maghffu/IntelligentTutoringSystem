@extends('template.user')
@section('konten')
<div class="card-panel green accent-4">
	<span class="white-text"><b>Quiz</b></span>
</div>
<div style="padding:10px;">
@if ($pesan == "ya")
	<p>Yaking ingin mengerjakan quiz {{$judul_materi}} ? 
		<a class="btn btn-primary" onclick="window.open('{{url('mhs/quiz')}}/{{$kd_materi}}','quiz {{$judul_materi}}','type=fullWindow,fullscreen,scrollbars=yes')">{{$button}}</a>
	</p>
	<br>
@else
	<h5>{{$pesan}} <a href="{{url('mhs/materi')}}"><button class="btn btn-primary">Materi</button></a></h5>
	<br>
</div>
	
@endif
@stop