<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Cliente extends Model implements AuditableContract
{
  use Auditable;
  protected $table = 'clientes';

  protected $fillable = ['id','nit','cedula','nombre','contacto','telefono','direccion','email','departamento_id','municipio'];

  public $timestamps = false;

    public function administrativa(){
      return $this->hasMany('App\Administrativa');
    }
    
    public function cotizacion(){
      return $this->hasMany('App\Cotizacion');
    }

    public function departamento(){
      return $this->belongsTo('App\Departamento');
    }
}
