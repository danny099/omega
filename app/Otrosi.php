<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Otrosi extends Model implements AuditableContract
{
  use Auditable;
  
  protected $table = 'otrosi';

  protected $fillable = ['id','valor','iva','valor_tot','detalles','administrativa_id','recuerdame'];

  public $timestamps = false;

  public function administrativa(){
    return $this->hasMany('App\Administrativa');
  }
}
