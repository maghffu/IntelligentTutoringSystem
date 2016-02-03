<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class latihan extends Model
{
    //
    protected $table = 'latihan';
    protected $fillable = ['kd_materi','panduan','hasil'];
    protected $primaryKey = 'kd_latihan';

    public function materi()
    {
        return $this->hasOne('App\materimodel','kd_materi','kd_materi');
    }

}
