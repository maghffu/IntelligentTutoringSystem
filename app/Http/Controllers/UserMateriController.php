<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\materimodel;
use App\user_log;
use App\Http\Controllers\Auth\AuthController as Auth;


class UserMateriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $this->getAll();
        $materi = materiModel::get();
        $data = array(
            'materi' => $materi, 
            'rek' => $user->rekomendasi_materi,
            'nama_user' => $user->nama_lengkap
            );
        return view('mhs.materi', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->getAll();
        $status_akhir = user_log::where('status', 0)->where('kd_belajar', 'M')->where('username', $user->username)->first();
        if ( empty($status_akhir) || $id == $status_akhir->kd_materi) {
            $detail = materimodel::find($id);
            $log = array('username' => $user->username, 'kd_materi' => $id, 'kd_belajar' => 'M', 'skor' => 1,'status'=>0 );
            if (empty($status_akhir->kd_materi)) {
                user_log::create($log);
            }
        }else{
            $detail = materimodel::find($status_akhir->kd_materi);
            $detail['belajar'] = "ya";
        }
            $ids = user_log::where('status', 0)->where('kd_belajar', 'M')->where('username', $user->username)->first();
            $detail['id'] = $ids->id;
            $detail['nama_user'] = $user->nama_lengkap;
            return view('mhs.materi_pelajari', $detail);
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


    ///////////////////////////////////////////////////////////////////////////////////////

    public function selesai($id)
    {
        user_log::where('id', $id)->update(['status' => 1]);
        return redirect('mhs/materi');
    }

}
