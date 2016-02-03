@extends('template.admin')
@section('konten')
	<div class="card-panel blue darken-3">
	<span class="white-text"><b>Input Soal</b></span>
	&nbsp;
</div>
<div class="row">

<form action="{{url('soal')}}/{{$soal->kd_soal}}" method="POST">
	{{csrf_field()}}
	<div class="input-field col s12">
		Kode Materi
		<select id="kdm" name="kd_materi">
			<option value="">--- Pilih Materi ---</option>
			@foreach($materi as $mat)
			<option  value="{{$mat->kd_materi}}" >{{$mat->judul_materi}}</option>
			@endforeach
		</select> 
	</div>
	<div class="input-field col s12">
       Input pertanyaan
		<textarea name="pertanyaan" id="isi">
			{{ $soal->pertanyaan }}
		</textarea>
   	</div>

   	<div class="input-field col s8">
       <input id="jawab_a" type="text" class="validate" name="jawab_a" value="{{ $soal->jawab_a }}">
       <label for="jawab_a">Input Pilihan a</label>
   	</div>
   	<div class="input-field col s4">
   		<input type="radio" name="jawaban" value="a" id="a"> <label for="a">Centang jika benar</label>
   	</div>

   	<div class="input-field col s8">
       <input id="jawab_b" type="text" class="validate" name="jawab_b" value="{{ $soal->jawab_b }}">
       <label for="jawab_b">Input Pilihan b</label>
   	</div>
   	<div class="input-field col s4">
   		<input type="radio" name="jawaban" value="b" id="b"> <label for="b">Centang jika benar</label>
   	</div>

   	<div class="input-field col s8">
       <input id="jawab_c" type="text" class="validate" name="jawab_c" value="{{ $soal->jawab_c }}">
       <label for="jawab_c">Input Pilihan c</label>
   	</div>
   	<div class="input-field col s4">
   		<input type="radio" name="jawaban" value="c" id="c"> <label for="c">Centang jika benar</label>
   	</div>

   	<div class="input-field col s8">
       <input id="jawab_d" type="text" class="validate" name="jawab_d" value="{{ $soal->jawab_d }}">
       <label for="jawab_d">Input Pilihan d</label>
   	</div>
   	<div class="input-field col s4">
   		<input type="radio" name="jawaban" value="d" id="d"> <label for="d">Centang jika benar</label>
   	</div>

	<div class="col m12">&nbsp;</div>
	<div class="col m12">
   <button class="btn waves-effect waves-light" type="submit">Update</button>
	</div>
   <div class="col m12">&nbsp;</div>
	
</form>
</div>

<script type="text/javascript">
	
@if($errors->has('kd_materi'))
Materialize.toast('Pilih Kode Materi dahulu', 3000, 'rounded') 
@endif

@if($errors->has('pertanyaan'))
Materialize.toast('Input dahulu pertanyaan', 3000, 'rounded') 
@endif

@if($errors->has('jawab_a'))
Materialize.toast('Input dahulu Pilihan A', 3000, 'rounded') 
@endif

@if($errors->has('jawab_b'))
Materialize.toast('Input dahulu Pilihan B', 3000, 'rounded') 
@endif

@if($errors->has('jawab_c'))
Materialize.toast('Input dahulu Pilihan C', 3000, 'rounded') 
@endif

@if($errors->has('jawab_d'))
Materialize.toast('Input dahulu Pilihan D', 3000, 'rounded') 
@endif

@if($errors->has('jawaban'))
Materialize.toast('Pilih Jawaban Benar', 3000, 'rounded') 
@endif
	
</script>
@stop