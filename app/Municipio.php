<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Illuminate\Support\Arr;
class Municipio extends Model implements AuditableContract
{
  use Auditable;

  protected $table = 'municipio';
  protected $fillable = ['id','departamento_id','nombre'];
  public $timestamps = false;

  public function departamento(){
    return $this->hasOne('App\Departamento');
  }

}
