@extends('template.user')
@section('konten')

@if(empty($belajar))

<div class="card-panel light-blue darken-4">
	<span class="white-text">{{$judul_materi}}</span>
</div>
<div class="card-panel">
	<div class="center">
		<video class="responsive-video" controls>
			<source src="{{asset('video')}}/{{$video}}" type="video/mp4">
			</video>
		</div>

	{!!$isi_materi!!}
</div>
<div class="fixed-action-btn active">
	<a href="{{url('mhs/materi/selesai')}}/{{$id}}" class="btn-floating btn-large waves-effect waves-light red tooltipped" data-position="left" data-delay="50" data-tooltip="Selesai"><i class="material-icons">remove_circle</i></a>         
</div>
@else

<div class="card-panel light-blue darken-4">
	<span class="white-text">Mohon selesaikan pembelajaran {{$judul_materi}} dahulu </span>
	<p><a href="{{url('mhs/materi')}}/{{$kd_materi}}" class="btn waves-effect waves-light">Pelajari {{$judul_materi}}</a></p>
</div>

@endif

@stop	