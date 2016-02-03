<?php
// use Auth;

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


Route::get('/', function () {
	return redirect('/auth/login');
	// return view('cekjava');
});
/*Route::get('mhs/latihan', function () {
	return view('cekjava');
});*/
Route::get('/home', function () {
	$users = Auth::user();
	return view('beranda', ['nama_user' => $users->nama_lengkap ]);
});

Route::get('materi/cari/{cari}', function ($cari) {
	echo $cari;
});
//########################################################################################
Route::get('user/{id}/{stts}', 'UserController@status' );

Route::resource('materi', 'Materi');
Route::resource('soal', 'soalController');
Route::resource('user', 'UserController');
Route::resource('latihan', 'latihanController');
Route::resource('mhs/materi', 'UserMateriController', ['except' => 'create', 'store', 'update']);
Route::resource('mhs/quiz', 'UserQuizController');
Route::resource('mhs/latihan', 'userLatihanController');

Route::get('mhs/materi/selesai/{kd_m}', 'UserMateriController@selesai');
Route::post('mhs/quiz/selesai', 'UserQuizController@selesai');
Route::get('mhs/quiz/simpan_jawaban/{jawaban}/{kd_soal}', 'UserQuizController@userjawab');
Route::get('mhs/latihan/selesai/{id}', 'userLatihanController@user_selesai');

Route::get('mhs/beranda', function ()
{
	return view('mhs.beranda',['nama_user' => Auth::user()->nama_lengkap]);
});
