<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\user_log;
use App\materimodel;
use App\soal_temp;
use App\latihan;

class userLatihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $this->getAll();
        $detail = array();
        /*$status_akhir = user_log::where('status', 1)->where('kd_belajar', 'M')->where('username', $user->username)->first();

        if ( $status_akhir == null || $status_akhir == "") {
            $detail = array('pesan' => 'Pelajari materi dahulu');
        }else{*/
            $detail= materimodel::find($user->rekomendasi_materi);
            $detail['pesan'] = "ya";
            $status_latihan = user_log::where('kd_materi', $user->rekomendasi_materi)->where('kd_belajar', 'L')->where('username', $user->username)->first();
            if ($status_latihan['status'] == 0) {
                $detail['button'] = "Kerjakan";
            }else{
                $detail['button'] = "Lanjutkan";
            }            
        // }
            $detail['nama_user'] = $user->nama_lengkap;
            return view('mhs.latihan', $detail);
        }

    public function show($id)
    {   $user = $this->getAll();
        $status_latihan = user_log::where('kd_materi', $user->rekomendasi_materi)->where('kd_belajar', 'L')->where('username', $user->username)->first();
        if ($status_latihan == null | empty($status_latihan)) {
            $log = array('username' => $user->username, 'kd_materi' => $id, 'kd_belajar' => 'L', 'skor' => 1,'status'=>0 );
            user_log::create($log);
            $status_latihan = user_log::where('kd_materi', $user->rekomendasi_materi)->where('kd_belajar', 'L')->where('username', $user->username)->first();
        }
        $lat = latihan::where('kd_materi',$id)->with('materi')->first();
        if ($lat == null | empty($lat) ) {
            return "Latihan Belum ada";
        }else{
            $lat['id_log'] = $status_latihan->id;
            if ($status_latihan->status == "1") {
                $lat['selesai'] = true;
            }
            return view('cekjava', $lat);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function user_selesai($id)
    {
        $log = user_log::find($id);
        $log->status=1;
        $log->save();
        return "Selamat, anda berhasil mengerjakan latihan";
    }
}
