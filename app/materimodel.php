<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class materimodel extends Model
{
    //
    protected $table = 'materi';
    protected $primaryKey = 'kd_materi';
    protected $fillable = array('judul_materi', 'isi_materi','thumbnail','video');

    public function soal()
    {
    	$this->hasMany('App\soal','kd_materi','kd_materi');
    }

    public static function gantiTable($a)
    {
		$table = $a;	
    }

}
