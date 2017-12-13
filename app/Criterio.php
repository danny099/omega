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
  protected $fillable = ['id','aplica','cumple','observaciones','tipo','fecha','administrativa_id','items_id'];
  public $timestamps = false;

  public function administrativa(){
    return $this->hasMany('App\Administrativa');
  }

  public function items(){
    return $this->belongsTo('App\Item');
  }

  public function transformAudit(array $data)
    {
        if (Arr::has($data, 'auditable_id')) {
            Arr::set($data, 'auditable_id',  $this->id);
        }

        return $data;
    }
}
