<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
  protected $table = 'municipio';
  protected $fillable = ['id','departamento_id','nombre'];
  public $timestamps = false;

  public function departamento(){
    return $this->hasOne('App\Departamento');
  }

}
