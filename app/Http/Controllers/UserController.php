<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = new User();
        $data = $model->where('status','!=','3')->paginate(5);
        return view('user', ['users' => $data , 'nama_user'=> $this->getUser() ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$validator = $this->validate($request, [
            'nim' => 'required|unique:user',
            'username' => 'required|unique:user',
            'jawab_a' => 'required',
            'jawab_b' => 'required',
            'jawab_c' => 'required',
            'jawab_d' => 'required',
            'jawaban' => 'required',
            'kd_materi' => 'required',
            ]);
        if ($validator) {
            return redirect('soal/create')
            ->withErrors($validator)
            ->withInput();
        }else{
            $model = new soal();
            $model->forceCreate($request->except('_token'));
            return redirect('soal');
        }*/
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

    function status($id,$stts)
    {
        $model = new User();
        $model->updateOrCreate(['username' => $id], ['status' => $stts]);
        $a = $stts==1?"Aktif":"Tidak Aktif";
        return "$id Telah $a";
    }

}
