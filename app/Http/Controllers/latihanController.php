<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\latihan;
use DB;

class latihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = latihan::paginate(5);
        return view('latihan', ['nama_user' => $this->getUser(), 'data'=>$data ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materi = DB::table('materi')->get();
        return view('latihan_form', ['materi' => $materi, 'nama_user'=> $this->getUser()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validate($request, [
            'panduan' => 'required',
            'hasil' => 'required',
            'kd_materi' => 'required',
            ]);
        if ($validator) {
            return redirect('latihan/create')
            ->withErrors($validator)
            ->withInput();
        }else{
            $model = new latihan();
            $model->forceCreate($request->except('_token'));
            return redirect('soal');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ambil = latihan::where('kd_latihan',$id)->first();
        $data = DB::table('materi')->get();
        return view('latihan_edit', [ 'latihan' => $ambil, 'materi' => $data , 'nama_user'=> $this->getUser()]);
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
        $model = new latihan();
        $model->updateOrCreate( [ 'kd_latihan' => $id ] , $request->except(['_token','_method']) );
        return redirect('latihan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        latihan::destroy($id);
        return redirect('latihan');
    }
}
