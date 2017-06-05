<?php

namespace App;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Illuminate\Database\Eloquent\Model;


class Valor_adicional extends Model implements AuditableContract
{
  use Auditable;

  protected $table = 'valor_adicional';
  protected $fillable = ['id','valor','detalle','administrativa_id'];
  public $timestamps = false;

  public function administrativa(){
    return $this->hasMany('App\Administrativa');
  }
}
