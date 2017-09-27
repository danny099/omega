<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Illuminate\Support\Arr;
class Administrativa extends Model implements AuditableContract
{
  use Auditable;

  protected $table = 'administrativa';

  protected $fillable = ['id','codigo_proyecto','nombre_proyecto','fecha_contrato','cliente_id','juridica_id','municipio','departamento_id','tipo_zona','valor_contrato_inicial','valor_iva','valor_adicional','valor_contrato_final','formas_pago','saldo','valor_total_contrato','recordar','recor_fac','contador_otro','contador_fac','id_cotizacion'];

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

  public function otrosi(){
    return $this->belongsTo('App\Otrosi');
  }
  public function observacion(){
    return $this->belongsTo('App\Observacion');
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

  public function factura(){
    return $this->belongsTo('App\Factura');
  }

  public function cuenta_cobro(){
    return $this->belongsTo('App\Cuenta_cobro');
  }

  public function consignacion(){
    return $this->belongsTo('App\Consignacion');
  }

  /**
   * Ingreso belongs to many (many-to-many) Elemento.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function usuarios()
  {
    // belongsToMany(RelatedModel, pivotTable, thisKeyOnPivot = ingreso_id, otherKeyOnPivot = elemento_id)
    return $this->belongsToMany(Usuario::class,'usuario_administrativa','administrativa_id','usuario_id');
  }
}
