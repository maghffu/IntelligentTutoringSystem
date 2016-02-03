@extends('template.admin')
@section('konten')
<div class="card-panel blue darken-3">
	<span class="white-text"><b>Pengguna</b></span>
</div>
<div>&nbsp;</div>
	<table class="bordered striped">
		<tr>
			<th>No</th>
			<th>Username</th>
			<th>Nama Lengkap</th>
			<th>Alamat</th>
			<th>Status</th>
		</tr>
		<?php $n=1; ?>
		@foreach($users as $user)
			<tr>
				<td>{{$n}}</td>
				<td>{{$user->username}}</td>
				<td>{{$user->nama_lengkap}}</td>
				<td>{{$user->alamat}}</td>
				<td>
					<select name="select" onchange="update('{{$user->username}}')" id="stts">
						<option value="1"  <?php echo $user->status=="1"?"selected":"" ?> >Aktif</option>
						<option value="0" <?php echo $user->status=="0"?"selected":"" ?>  >Tidak Aktif</option>
					</select>
				</td>
			</tr>
			<?php $n++ ?>
		@endforeach
	</table>
	<div class="center">
	{!! $users->render() !!}
	</div>
	<div class="center">&nbsp;</div>
	<script type="text/javascript">
		function update (username) {
			var a = $('#stts').val();
			
			$.ajax({
				url:"{{url('user')}}/"+username+"/"+a,
				success: function (data) {
					alert(data);
				}
			});
		}
	</script>
@stop