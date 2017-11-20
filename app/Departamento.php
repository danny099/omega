<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Departamento extends Model implements AuditableContract
{
  use Auditable;

  protected $table = 'departamento';
  protected $fillable = ['id','nombre'];
  public $timestamps = false;

  public function administrativa(){
    return $this->hasOne('App\Administrativa');
  }

  public function cotizacion(){
    return $this->hasMany('App\Cotizacion');
  }
  
  public function municipio(){
    return $this->belongsTo('App\Municipio');
  }

  public function cliente(){
    return $this->hasOne('App\Cliente');
  }
  public function juridica(){
    return $this->hasOne('App\Juridica');
  }
}
