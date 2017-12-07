<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Illuminate\Support\Arr;

class Nc extends Model implements AuditableContract
{
  use Auditable;

  protected $table = 'nc';
  protected $fillable = ['id','nc'];
  public $timestamps = false;

  public function descripcion(){
    return $this->belongsTo('App\Descripcion');
  }
}