@extends('template.admin')
@section('konten')
<div class="card-panel blue darken-3">
    <span class="white-text"><b>Kumpulan Soal</b></span>
    <div class="right">
		<a href="{{url('soal/create')}}" class="btn-floating btn-large waves-effect waves-light green tooltipped" data-position="left" data-delay="50" data-tooltip="Tambah Soal">
			<i class="material-icons">add</i>
		</a>
	</div>
</div>

<table class="bordered">
	<tr>
		<td rowspan="2" >No</td>
		<td rowspan="2" >Pertanyaan</td>
		<td colspan="4">Pilihan</td>
		<td rowspan="2" >jawaban benar</td>
		<td rowspan="2" >nama materi</td>
		<td rowspan="2" >Terakhir update</td>
		<td rowspan="2" >Aksi</td>
	</tr>
	<tr>
		<td>a</td>
		<td>b</td>
		<td>c</td>
		<td>d</td>
	</tr>
	<?php $n=1; ?>
	@foreach($soals as $soal)
	<tr>
		<td>{{$soal->kd_soal}}</td>
		<td>{{$soal->pertanyaan}}</td>
		<td>{{$soal->jawab_a}}</td>
		<td>{{$soal->jawab_b}}</td>
		<td>{{$soal->jawab_c}}</td>
		<td>{{$soal->jawab_d}}</td>
		<td>{{$soal->jawaban}}</td>
		<td>{{$soal->materi->judul_materi}}</td>
		<td>{{ date('d F Y H:i:s', strtotime($soal->updated_at)) }}</td>
		<td>
			<form action="{{url('/soal')}}/{{ $soal->kd_soal }}" method="POST">
			<a href="{{url('soal')}}/{{$soal->kd_soal}}/edit" class="btn waves-effect waves-light amber darken-3 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Edit soal">
				<i class="material-icons">border_color</i>
			</a>
				{{ csrf_field() }}
				{{ method_field('DELETE') }}
				<button class="btn waves-effect waves-light red tooltipped" type="button" onclick="hapus({{$n}})" data-position="bottom" data-delay="50" data-tooltip="Hapus Soal">
					<i class="material-icons">delete</i>
				</button>
				<input type="submit" class="sbmtn{{$n}}" hidden>
			</form>
		</td>
	</tr>
	<?php $n++; ?>
	@endforeach
</table>
<script type="text/javascript">
	function hapus (n) {
		var ya = confirm("Yakin ingin hapus");
		if (ya) {
			$('.sbmtn'+n).trigger('click');
		};
	}
</script>
@stop