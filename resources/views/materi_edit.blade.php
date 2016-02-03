@extends('template.admin')
@section('konten')
<div class="card-panel blue darken-3">
    <span class="white-text"><b>Edit Materi</b></span>
</div>
<form action="{{url('materi')}}/{{$data->kd_materi}}" enctype="multipart/form-data" files='true' method="POST">
	{{ csrf_field() }}
	{{ method_field('PUT') }}

	 <div class="input-field col s12">
       <input id="judul_materi" type="text" class="validate" name="judul_materi" value="{{$data->judul_materi}}">
       <label for="judul_materi">Edit Judul</label>
   </div>


   <div class="input-field  file-field col s12">
    <div class="btn">
        <span>Gambar</span>
        <input type="text" name="thumbnail" value="{{$data->thumbnail}}" hidden>
        <input type="file" name="file_gambar" accept="image/*" >
     </div>
     <div class="file-path-wrapper">
        <input class="file-path validate" type="text" placeholder="gambar thumbnail">
      </div>
   </div>

   <div class="input-field  file-field col s12">
    <div class="btn">
        <span>Video</span>
        <input type="text" name="video" value="{{$data->video}}" hidden>
        <input type="file" name="file_video" accept="video/*" >
     </div>
     <div class="file-path-wrapper">
        <input class="file-path validate" type="text" placeholder="Upload Video">
      </div>
   </div>

	Isi Materi
	<textarea name="isi_materi" id="isi">
		{{$data->isi_materi}}
	</textarea>
	<div class="col m12">&nbsp;</div>
	<button class="btn waves-effect waves-light" type="submit">
		Update
	</button>
	<div class="col m12">&nbsp;</div>
</form>
 @stop