@extends('template.admin')
@section('konten')
<div class="card-panel blue darken-3">
    <span class="white-text"><b>Tambah Materi</b></span>
</div>
<form action="{{url('materi')}}" method="POST" enctype="multipart/form-data" files='true'>
    {{ csrf_field() }}

    <div class="input-field col s12">
       <input id="judul_materi" type="text" class="validate" name="judul_materi" value="{{ old('judul_materi') }}">
       <label for="judul_materi">Input Judul</label>
   </div>

   <div class="input-field  file-field col s12">
    <div class="btn">
        <span>Gambar</span>
        <input type="file" name="thumbnail" accept="image/*" >
     </div>
     <div class="file-path-wrapper">
        <input class="file-path validate" type="text" placeholder="gambar thumbnail">
      </div>
   </div>

   <div class="input-field  file-field col s12">
    <div class="btn">
        <span>Video</span>
        <input type="file" name="video" accept="video/mp4" >
     </div>
     <div class="file-path-wrapper">
        <input class="file-path validate" type="text" placeholder="Upload Video">
      </div>
   </div>

   <div class="col m12">&nbsp;</div>
   Isi Materi <textarea name="isi_materi" id="isi"></textarea>
   <div class="col m12">&nbsp;</div>
   <button class="btn waves-effect waves-light" type="submit">Simpan</button>
   <div class="col m12">&nbsp;</div>
</form>

<script type="text/javascript">
@if ($errors->has('judul_materi'))
     Materialize.toast('Judul Materi tidak boleh kosong', 3000, 'rounded') 
@endif

@if ($errors->has('isi_materi'))
     Materialize.toast('Isi Materi tidak boleh kosong', 3000, 'rounded') 
@endif
</script>
@stop