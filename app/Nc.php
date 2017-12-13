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
  protected $fillable = ['id','nc','descripcion_id'];
  public $timestamps = false;

  public function descripcion(){
    return $this->hasMany('App\Descripcion');
  }

  public function transformAudit(array $data)
  {
      if (Arr::has($data, 'auditable_id')) {
          Arr::set($data, 'auditable_id',  $this->nc);
      }

      return $data;
  }
}