@extends('template.user')
@section('konten')
<div class="card-panel green accent-4">
	<span class="white-text"><b>Latihan</b></span>
</div>
<div style="padding:10px;">
@if ($pesan == "ya")
	<p>Yaking ingin mengerjakan Latihan {{$judul_materi}} ? 
		&nbsp;&nbsp;&nbsp;<a class="btn btn-primary" onclick="window.open('{{url('mhs/latihan')}}/{{$kd_materi}}','quiz {{$judul_materi}}','type=fullWindow,fullscreen,scrollbars=yes')">{{$button}}</a>
	</p>
	
@else
	<h5>{{$pesan}} 
		<a href="{{url('mhs/materi')}}"><button class="btn btn-primary">Materi</button></a>
	</h5>
	
	
@endif
<hr>
<h5>Petunjuk Latihan</h5>
<ol>
	<li>Baca Petunjuk koding</li>
	<li>Ketikan kode program pada text editor</li>
	<li>klik run untuk menjalankan program</li>
	<li>akan muncul hasil dari baris program</li>
</ol>
</div>
@stop