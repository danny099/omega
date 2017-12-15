<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Illuminate\Support\Arr;

class Dictamen extends Model implements AuditableContract
{
  use Auditable;

  protected $table = 'dictamenes';
  protected $fillable = ['id','matricula','director_tec','matricula_tec','codigo_dic','proceso_dic','cantidad','equipo','fecha_des','fecha_has','fecha_auto','administrativa_id','inspectores_id'];
  public $timestamps = false;

  public function administrativa(){
      	return $this->hasMany('App\Administrativa');
  }
  public function inspectores(){
        return $this->belongsTo('App\Inspector');
  }

  public function transformAudit(array $data)
  {
      if (Arr::has($data, 'auditable_id')) {
          Arr::set($data, 'auditable_id',  $this->id);
      }

      return $data;
  }
}