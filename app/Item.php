<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Illuminate\Support\Arr;

class Item extends Model implements AuditableContract
{
  use Auditable;

  protected $table = 'items';
  protected $fillable = ['id','item','tipo'];
  public $timestamps = false;

  public function criterio(){
    return $this->hasMany('App\Criterio');
  }
}
