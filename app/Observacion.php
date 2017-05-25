<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
  protected $table = 'observacion';

  protected $fillable = ['id','observacion','administrativa_id'];


  public function administrativa(){
    return $this->hasMany('App\Administrativa');
  }
}
