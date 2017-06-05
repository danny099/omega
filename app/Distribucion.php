<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Distribucion extends Model implements AuditableContract
{
  use Auditable;

  protected $table = 'distribucion';

  protected $fillable = ['id','descripcion','tipo','unidad','cantidad','administrativa_id'];

  public $timestamps = false;

  public function administrativa(){
    return $this->hasMany('App\Administrativa');
  }
}
