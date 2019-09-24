<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailCD extends Model
{
    //
    protected $table = 'cd_detail';

    public function header(){
        return $this->belongsTo('App\CD', 'cd_header_id');
    }

    public function kategoris(){
        return $this->belongsToMany('App\Kategori', 'cd_detail_kategori', 'cd_detail_id', 'kategori_id');
    }
}