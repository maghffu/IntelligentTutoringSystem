<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class soal_temp extends Model
{
	protected $table="soal_temp";
	protected $primaryKey = "kd_soal";
	protected $fillable=['kd_soal','pertanyaan','kd_materi','jawab_a','jawab_b','jawab_c','jawab_d','jawaban','username'];

	public function materi()
    {
    	# code...
        return $this->hasOne('App\materimodel','kd_materi','kd_materi');
    }
}
