<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class user_log extends Model
{
    //
    protected $table='log_user';
    protected $fillable = ['kd_belajar','skor','username','kd_materi','status'];

    public static function getWaktu($kd_materi,$username,$kd)
    {
	 	return DB::table('log_user')
	 			->select( DB::raw(' SUM( updated_at - created_at) as waktu ') )
	 			->where('kd_materi',$kd_materi)
	 			->where('kd_belajar',$kd)
	 			->where('username',$username)
	 			->groupBy('kd_belajar')
	 			->groupBy('kd_materi')
	 			->groupBy('username')->first();
    }
}
