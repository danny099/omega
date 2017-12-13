<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Illuminate\Support\Arr;

class Descripcion extends Model implements AuditableContract
{
  use Auditable;

  protected $table = 'descripcion';
  protected $fillable = ['id','descripcion','fecha','administrativa_id'];
  public $timestamps = false;

  public function administrativa(){
    return $this->hasMany('App\Administrativa');
  }
  public function ncs(){
    return $this->belongsTo('App\Nc');
  }

  public function transformAudit(array $data)
  {
      if (Arr::has($data, 'auditable_id')) {
          Arr::set($data, 'auditable_id',  $this->descripcion);
      }

      return $data;
  }
}