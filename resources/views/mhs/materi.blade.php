@extends('template.user')
@section('konten')

<div class="card-panel green accent-4">
	<span class="white-text"><b>Materi</b></span>
</div>
	<div class="col s12 m12 selesai" hidden>
		<div class="card" style="padding:10px;">
			<h5 class="pink-text">Selamat anda telah <b>Menguasai</b> Mata kuliah <b>Pemrograman Berorientasi Objek 1</b></h5>
		</div>
	</div>
<?php $n=1; ?>
	@foreach($materi as $m)
	<div class="col s6 m4">
	<div class="card small ">
		<div class="card-image waves-effect waves-block waves-light">
			<img <?php if ($n<=$rek): ?> class="activator" <?php else: ?> style="opacity:0.5" onclick="alert('Selesaikan Materi Rekomendasi')" <?php endif ?> src="{{asset('thumbnail')}}/{{$m->thumbnail}}">
		</div>
		<div class="card-content">
			<span class="card-title grey-text text-darken-4 <?php if ($n<=$rek): ?> activator<?php endif ?>" <?php if ($n>$rek): ?>onclick="alert('Selesaikan Materi Rekomendasi')"<?php endif ?>>{{$m->judul_materi}}<i class="material-icons right">more_vert</i></span>
		</div>
		<div class="card-reveal">
			<span class="card-title grey-text text-darken-4">{{$m->judul_materi}}<i class="material-icons right">close</i></span>
			<p><a href="{{url('mhs/materi')}}/{{$m->kd_materi}}" class="btn waves-effect waves-light">Pelajari</a></p>
			{!! str_limit( $m->isi_materi , $limit = 200, $end = '...') !!}
			<p class="right blue-grey-text">Terakhir Update {{ date('d F Y H:i:s', strtotime($m->updated_at)) }}</p>
		</div>
	</div>
	</div>
	<?php $n++ ?>
	@endforeach
	<script type="text/javascript">
		<?php if (true): ?>
			$('.selesai').hide();
			$('.selesai').slideDown('slow');
		<?php endif ?>
	</script>

@stop