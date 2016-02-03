@extends('template.admin')
@section('konten')
<div class="card-panel blue darken-3">
	<span class="white-text"><b>Materi</b></span>
	<div class="right">
		<a href="{{url('materi/create')}}" class="btn-floating btn-large waves-effect waves-light green tooltipped" data-position="left" data-delay="50" data-tooltip="Tambah Materi">
			<i class="material-icons">add</i>
		</a>
		
	</div>
</div>
<div>&nbsp;</div>
<table class='striped bordered'>
	<tr>
		<td>No</td>
		<td>Judul</td>
		<td>Isi materi</td>
		<td>Update</td>
		<td>Aksi</td>
	</tr>
	<?php $n=1; ?>
	@foreach($data as $dt)
	<tr>
		<td>{{$n}}</td>
		<td>{{$dt->judul_materi}}</td>
		<td>{!! str_limit( $dt->isi_materi , $limit = 150, $end = '...') !!}</td>
		<td>{{ date('d F Y H:i:s', strtotime($dt->updated_at)) }}</td>
		<td>
			<form action="{{url('/materi')}}/{{ $dt->kd_materi }}" method="POST">
				{{ csrf_field() }}
				{{ method_field('DELETE') }}
				<a href="{{url('materi')}}/{{$dt->kd_materi}}/edit" class="btn waves-effect waves-light amber darken-3 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Edit Materi">
					<i class="material-icons">border_color</i>
				</a>
				<button class="btn waves-effect waves-light red tooltipped" type="button" onclick="hapus({{$n}})" data-position="bottom" data-delay="50" data-tooltip="Hapus Materi">
					<i class="material-icons">delete</i>
				</button>
				<input type="submit" class="sbmtn{{$n}}" hidden>
			</form>
		</td>
	</tr>
	<?php $n++; ?>
	@endforeach
</table>
<div>&nbsp;</div>
<div class="center">
	{!! $data->render() !!}
</div>
<div>&nbsp;</div>
<script type="text/javascript">
function hapus(n){
	var ya = confirm("yakin ingin hapus?");
	console.log(ya);
	if (ya) {
		$('.sbmtn'+n).trigger('click');
	}else{
		return false;
	}
}
</script>
@stop