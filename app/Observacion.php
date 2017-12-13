<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Illuminate\Support\Arr;;

class Observacion extends Model implements AuditableContract
{
  use Auditable;

  protected $table = 'observacion';

  protected $fillable = ['id','observacion','administrativa_id'];

  public function administrativa(){
    return $this->hasMany('App\Administrativa');
  }

  public function transformAudit(array $data)
  {
      if (Arr::has($data, 'auditable_id')) {
          Arr::set($data, 'auditable_id',  $this->id);
      }

      return $data;
  }
}
