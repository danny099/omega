<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Illuminate\Support\Arr;

class Criterio extends Model implements AuditableContract
{
  use Auditable;

  protected $table = 'criterios';
  protected $fillable = ['id','aplica','cumple','observaciones','tipo','administrativa_id','item_id'];
  public $timestamps = false;

  public function administrativa(){
    return $this->hasMany('App\Administrativa');
  }

  public function item(){
    return $this->hasMany('App\item_id');
  }
}
