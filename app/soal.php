<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class soal extends Model
{
    protected $table="soal";
    protected $primaryKey = "kd_soal";
    protected $fillable=['pertanyaan','kd_materi','jawab_a','jawab_b','jawab_c','jawab_d','jawaban'];

    public function materi()
    {
    	# code...
        return $this->hasOne('App\materimodel','kd_materi','kd_materi');
    }


}
