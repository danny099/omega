<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Illuminate\Support\Arr;

class Inspector extends Model implements AuditableContract
{
  use Auditable;

  protected $table = 'inspectores';
  protected $fillable = ['id','nombres','apellidos','matricula','rol_inspector'];
  public $timestamps = false;

  public function dictamenes(){
      	return $this->belongsTo('App\Dictamen');
  }

  public function transformAudit(array $data)
  {
      if (Arr::has($data, 'auditable_id')) {
          Arr::set($data, 'auditable_id',  $this->id);
      }

      return $data;
  }
}