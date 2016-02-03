@extends('template.admin')
@section('konten')
<div class="card-panel blue darken-3">
  <span class="white-text"><b>Input Latihan</b></span>
  &nbsp;
</div>
<div class="row">
<div class="container">

  <form action="{{url('latihan')}}/{{$latihan->kd_latihan}}" method="POST" >
    {{csrf_field()}}
      {{ method_field('PUT') }}

    <div class="input-field col s12 offset-s2">
      Kode Materi
      <select id="kdm" name="kd_materi">
        <option value="">--- Pilih Materi ---</option>
        @foreach($materi as $mat)
        <option  value="{{$mat->kd_materi}}" >{{$mat->judul_materi}}</option>
        @endforeach
      </select> 
    </div>

    <div class="input-field col s12 offset-s2">
     Input Panduan
     <textarea name="panduan" id="isi">
      {{ $latihan->panduan }}
    </textarea>
  </div>
    <div class="col s2">&nbsp;</div>

    <div class="col s2">&nbsp;</div>
  <div class="input-field col s12">
    Input hasil program
    <textarea name="hasil">{{ $latihan->hasil }}</textarea>
  </div>

  <div class="col m12">&nbsp;</div>
  <div class="col m12">
   <button class="btn waves-effect waves-light" type="submit">Update</button>
 </div>
 <div class="col m12">&nbsp;</div>

</form>
</div>
</div>
<script type="text/javascript">

@if($errors->has('kd_materi'))
Materialize.toast('Pilih Kode Materi dahulu', 3000, 'rounded') 
@endif

@if($errors->has('panduan'))
Materialize.toast('Input Panduan latihan dahulu', 3000, 'rounded') 
@endif

@if($errors->has('hasil'))
Materialize.toast('Input hasil kode program dahulu', 3000, 'rounded') 
@endif

</script>


@stop