<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Illuminate\Support\Arr;
class Cotizacion extends Model implements AuditableContract
{
  use Auditable;

  protected $table = 'cotizacion';

  protected $fillable = ['id','dirigido','codigo','cliente_id','juridica_id','fecha','nombre','municipio','formas_pago','tiempo','entrega','visitas','validez','subtotal','iva','total','adicional','observaciones','departamento_id','contador'];

  public $timestamps = false;

  public function transformAudit(array $data)
  {
      if (Arr::has($data, 'auditable_id')) {
          Arr::set($data, 'auditable_id',  $this->codigo);
      }

      return $data;
  }

  public function cliente(){
    return $this->belongsTo('App\Cliente');
  }

  public function valorcot(){
    return $this->belongsTo('App\Valorcot');
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
