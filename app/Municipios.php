<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Illuminate\Support\Arr;

class Municipios extends Model implements AuditableContract
{
  use Auditable;

  protected $table = 'Municipios';
  protected $fillable = ['nombre','departamento_id'];
  public $timestamps = false;

  public static function municipios($id){
    return Municipios::where('departamento_id','=',$id)
    ->get();
  }
}
