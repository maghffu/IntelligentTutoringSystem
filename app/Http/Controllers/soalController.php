<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\soal;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;


class soalController extends Controller
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
        $modal= new soal();
        $soal = $modal->with('materi')->get();
        return view('soal', ['soals' => $soal, 'nama_user' => $this->getUser() ]);
        // return $soal;    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mater = DB::table('materi')->get();
        return view('soal_form', ['materi' => $mater, 'nama_user'=> $this->getUser()]);
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
            'pertanyaan' => 'required|unique:soal',
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
        $model = new soal();
        $soal = $model->findOrFail($id);
        $data = DB::table('materi')->get();
        return view('soal_edit', [ 'soal' => $soal, 'materi' => $data , 'nama_user'=> $this->getUser()]);
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
        $model = new soal();
        $model->updateOrCreate( [ 'kd_soal' => $id ] , $request->except(['_token','_method']) );
        return redirect('soal');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modal= new soal();
        $modal->destroy($id);
        return redirect('soal');
    }


}
