<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipios extends Model
{
  protected $table = 'Municipios';
  protected $fillable = ['nombre','departamento_id'];
  public $timestamps = false;

  public static function municipios($id){
    return Municipios::where('departamento_id','=',$id)
    ->get();
  }
}
