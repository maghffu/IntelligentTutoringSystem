<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\materimodel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Auth;

class Materi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */        
    function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = $this->getModel()->paginate(5);
        return view('materi',['data' => $data,'nama_user'=> $this->getUser() ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        return view('materi_form', ['nama_user'=> $this->getUser()]);
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
            'judul_materi' => 'required|unique:materi',
            'isi_materi' => 'required',
            ]);
        if ($validator) {
            return redirect('materi/create')
            ->withErrors($validator)
            ->withInput();
        }else{
            $fileName = "";
            $videoName = "";
            
            if ($request->hasFile('video')) {
                $videoName = str_random(20).".".$request->file('video')->getClientOriginalExtension();
                $request->file('video')->move('video', $videoName);
            }

            if ($request->hasFile('thumbnail')) {
                $fileName = str_random(20).".".$request->file('thumbnail')->getClientOriginalExtension();
                $request->file('thumbnail')->move('thumbnail', $fileName);
            }
            
            $obj = $request->except('_token');
            $obj['thumbnail'] = $fileName;
            $obj['video'] = $videoName;
            $this->getModel()->forceCreate($obj);
            return redirect('materi');
           // dd($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = '')
    {
        echo "regedek";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->getModel()->findOrFail($id);
        return view('materi_edit', [ 'data' => $data, 'nama_user'=> $this->getUser() ]);
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
        $nama_gambar = explode('.', $request->thumbnail);
        $nama_video = explode('.', $request->video);
        $simpanan = $request->except(['_token','_method']);

        if ($request->hasFile('file_video')) {
            $simpanan['video'] = $nama_video[0].".".$request->file('file_video')->getClientOriginalExtension();
            $request->file('file_video')->move('video', $simpanan['video']);
        }

        if ($request->hasFile('file_gambar')) {
            $simpanan['thumbnail'] = $nama_gambar[0].".".$request->file('file_gambar')->getClientOriginalExtension();
            $request->file('file_gambar')->move('thumbnail', $simpanan['thumbnail'] );
        }

        $this->getModel()->updateOrCreate( [ 'kd_materi' => $id ] ,$simpanan);
        return redirect('materi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->getModel()->destroy($id);
        return redirect('materi');
    }

    function getModel()
    {
        $model = new materimodel();
        return $model;
    }

}
