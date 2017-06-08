<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
  protected $table = 'cotizacion';

  protected $fillable = ['id','codigo','cliente_id','juridica_id','nombre_proyecto','direccion','municipio','departamento_id'];

  public $timestamps = false;

  public function transformAudit(array $data)
  {
      if (Arr::has($data, 'auditable_id')) {
          Arr::set($data, 'auditable_id',  $this->codigo_proyecto);
      }

      return $data;
  }

  public function cliente(){
    return $this->belongsTo('App\Cliente');
  }

  public function juridica(){
    return $this->belongsTo('App\Juridica');
  }

  public function transformacion(){
    return $this->belongsTo('App\Transformacion');
  }

  public function distribucion(){
    return $this->belongsTo('App\Distribucion');
  }

  public function pu_final(){
    return $this->belongsTo('App\Pu_final');
  }
  
  public function departamento(){
    return $this->belongsTo('App\Departamento');
  }


}
