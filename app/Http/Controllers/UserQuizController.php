<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\user_log;
use App\soal_temp;
use App\soal;
use App\user;
use App\materimodel;

class UserQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $this->getAll();
        // $status_akhir = user_log::where('status', 1)->where('kd_belajar', 'M')->where('username', $user->username)->first();

        
        $detail= materimodel::find($user->rekomendasi_materi);
        $detail['pesan'] = "ya";
        $status_quiz = soal_temp::where('username', $user->username)->first();
        if ($status_quiz == null || $status_quiz =="") {
            $detail['button'] = "Kerjakan";
        }else{
            $detail['button'] = "Lanjutkan";
        }            
        
        $detail['nama_user'] = $user->nama_lengkap;
        return view('mhs.quiz', $detail);
    }

    public function show($id)
    {
        $user = $this->getAll();
        $cek = soal_temp::where('username',$user->username)->first();
        if ($cek == null) {
            $ambil_soal = soal::where('kd_materi', $id )->orderByRaw("RAND()")->take(25)->get();
            foreach ($ambil_soal as $data) {
                $simpan = array(
                    'kd_soal' => $data->kd_soal,
                    'kd_materi' => $data->kd_materi,
                    'pertanyaan' => $data->pertanyaan,
                    'jawab_a' => $data->jawab_a,
                    'jawab_b' => $data->jawab_b,
                    'jawab_c' => $data->jawab_c,
                    'jawab_d' => $data->jawab_d,
                    'username' => $user->username
                    );
                $materi = $data->kd_materi;
                soal_temp::create($simpan);
            }
            $log = array('username' => $user->username, 'kd_materi' => $id, 'kd_belajar' => 'Q', 'skor' => 0,'status'=>0 );
            user_log::create($log);
        }else{
            $materi =$cek->kd_materi;
        }
        soal_temp::where('username',$user->username)->get();
        $materi = materimodel::select('judul_materi')->where('kd_materi',$materi)->first();
        $waktu = user_log::select('created_at','id')
        ->where('kd_materi',$id)
        ->where('kd_belajar','Q')
        ->where('username',$user->username)
        ->where('status', 0)
        ->first();
        $soal = array(
            'soal' => soal_temp::where('username',$user->username)->get(), 
            'judul' => $materi->judul_materi,
            'id_log' => $waktu->id,
            'waktu' => date_add($waktu->created_at, date_interval_create_from_date_string("60 MINUTES"))
            );
        return view('mhs/quiz_view',$soal);
    }

////////////////////////////////////////////////////
    public function selesai(Request $request)
    {
        $user = $this->getAll();
        $benar = 0;
        $n=0;
        $id_materi;
        foreach ($request->kd as $k) {
            $jawaban_benar = soal::select('jawaban','kd_materi')->where('kd_soal',$k)->first();
            $jawaban_user = soal_temp::select('jawaban')->where('kd_soal',$k)->where('username',$user->username)->first();
            $b = $jawaban_benar->jawaban;
            $u = $jawaban_user->jawaban;
            $b==$u?$benar++:"";
            $n++;
            $id_materi = $jawaban_benar->kd_materi;
        }
        $log = user_log::find($request->id_log);
        $log->status=1;
        $log->save();
        soal_temp::where('username', $user->username)->delete();

        $wktumateri = user_log::getWaktu($id_materi, $user->username,'M');
        $wktuLatihan = user_log::getWaktu($id_materi,$user->username,'L');
        $nilai = $benar/$n*100;
        
        /*echo "waktu mempelajari materi : ".$wktumateri->waktu."detik <br>";
        echo "waktu mengerjakan Latihan : ".$wktuLatihan->waktu."detik <br>";
        echo "waktu mengerjakan Quiz : ".$wktuQuiz->waktu."detik <br>";
        echo "Nilai Quiz : ".$nilai."<br>";
        */

        $wMateriCepat = $this->cepat($wktumateri->waktu, 20000, 10000);
        $wMateriLambat = $this->lambat($wktumateri->waktu, 20000,10000  );
      
        $WlatihanCepat = $this->cepat($wktuLatihan->waktu, 20000 ,13000 );
        $WlatihanLambat = $this->lambat($wktuLatihan->waktu, 20000 ,13000  );

        $nTinggi = $this->nilaiTinggi($nilai, 65, 100);
        $nRendah = $this->nilaiRendah($nilai, 75);

        // R1 materi cepat dan latihan cepat dan quiz tinggi maka lanjut
            $a1 = $this->carimin(array( $wMateriCepat, $WlatihanCepat, $nTinggi ));
            $z1 = $this->zlanjut(100,70,$a1);
            
        // R2 materi cepat dan latihan cepat dan quiz rendah maka lanjut
            $a2 = $this->carimin(array( $wMateriCepat, $WlatihanCepat, $nRendah ));
            $z2 = $this->zlanjut(100,70,$a2);

        // R3 materi cepat dan latihan lambat dan quiz tinggi maka lanjut
            $a3 = $this->carimin(array( $wMateriCepat, $WlatihanLambat, $nTinggi ));
            $z3 = $this->zlanjut(100,70,$a3);

        // R4 materi cepat dan latihan lambat dan quiz rendah maka tetap
            $a4 = $this->carimin(array( $wMateriCepat, $WlatihanLambat, $nRendah ));
            $z4 = $this->ztetap(69,$a4);

        // R5 materi lambat dan latihan cepat dan quiz tinggi maka lanjut
            $a5 = $this->carimin(array( $wMateriLambat, $WlatihanCepat, $nTinggi ));
            $z5 = $this->zlanjut(100,70,$a5);

        // R6 materi lambat dan latihan cepat dan quiz rendah maka tetap
            $a6 = $this->carimin(array( $wMateriLambat, $WlatihanCepat, $nRendah ));
            $z6 = $this->ztetap(69,$a6);

        // R7 materi lambat dan latihan lambat dan quiz tinggi maka lanjut
            $a7 = $this->carimin(array( $wMateriLambat, $WlatihanLambat, $nTinggi ));
            $z7 = $this->zlanjut(100,70,$a7);

        // R8 materi lambat dan latihan lambat dan quiz rendah maka tetap
            $a8 = $this->carimin(array( $wMateriLambat, $WlatihanLambat, $nRendah ));
            $z8 = $this->ztetap(69,$a8);
            

            $az = ($a1*$z1) +($a2*$z2) +($a3*$z3) +($a4*$z4) +($a5*$z5) +($a6*$z6)+($a7*$z7)+($a8*$z8);
            $a = $a1 +$a2 +$a3 +$a4 +$a5 +$a6 +$a7 +$a8;

            $ztot = $az/$a;

       
        $param = array(
            'z' => $ztot,
            'wm' =>$wktumateri->waktu,
            'nilai' =>$nilai,
            'wl'=> $wktuLatihan->waktu,
            'kd_materi' => $id_materi,
            'judul' => materimodel::where('kd_materi',$id_materi)->first()
            );
        $this->update_user($param);
        return view('mhs.UserHasilQuiz', $param);

    }       

    public function userjawab($jawaban, $kd_soal)
    {
        $user = $this->getAll();
        soal_temp::where('kd_soal',$kd_soal)->where('username',$user->username)->update(['jawaban' => $jawaban]);
    }

    public function cepat($nilai, $atas, $bawah)
    {
        if($nilai <= $bawah){ 
          return 1;
      }else if ($nilai >= $atas){
          return 0;
      }else{
       $wc=($atas-$nilai)/($atas-$bawah);
       return $wc;
   }  
}

public function lambat($nilai,$atas,$bawah)
{
    if($nilai<=$bawah){ 
      return 0;
  }else if ($nilai>=$atas){ 
      return 1;
  }else{
      $wl=($nilai-$bawah)/($atas-$bawah);
      return $wl;
  } 
}

public function nilaiRendah($nilai,$batasAtas)
{
    if($nilai<=0){
        return 1;
    }else if ($nilai>=$batasAtas){ 
        return 0;
    }else{                  
     $nr=($batasAtas-$nilai)/($batasAtas);
     return $nr;
 }
}
public function nilaiTinggi($nilai, $batasBawah,$batasAtas)
{
        if($nilai<=$batasBawah){  
            return 0;         
        }else if ($nilai>=$batasAtas){
            return 1;              
        }else{
            $nt=($nilai-$batasBawah)/($batasAtas-$batasBawah);  
            return $nt;
        }
}

public function zlanjut($atas,$bawah,$alpha)
{
    $z = $atas+(($atas-$bawah)*$alpha);
    return $z;
}

public function ztetap($atas,$alpha)
{
    $z = $atas-($atas*$alpha);
    return $z;
}

public function carimin($parameters = array())
{
    sort($parameters);
    return $parameters[0];
}

public function update_user($par = array())
{
    $user = $this->getAll();
   if ($par['z'] >= 70 ) {
        $log = array('username' => $user->username, 'kd_materi' => $par['kd_materi'], 'kd_belajar' => 'N', 'skor' => $par['z'],'status'=>1 );
        user_log::create($log);
        $ambil = user::where('username', $user->username)->first();
        $rek = $ambil->rekomendasi_materi + 1;
        user::where('username',$user->username)->update(['rekomendasi_materi' => $rek]);
        soal_temp::where('username',$user->username)->delete();
   }else{
        user_log::where('username',$user->username)->where('kd_materi', $par['kd_materi'])->delete();
   }
}

}