<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrativa extends Model
{
  protected $table = 'administrativa';

  protected $fillable = ['id','codigo_proyecto','nombre_proyecto','fecha_contrato','cliente_id',
  'propietario','municipio_id','departamento','tipo_zona','valor_contrato_inicial','otrosi_id','valor_contrato_final','plan_pago','resumen','transformacion_id','distribucion_id','pu_final_id'];

  public $timestamps = false;

  public function cliente(){
    return $this->belongsTo('App\cliente');
  }

  public function otrosi(){
    return $this->belongsTo('App\Otrosi');
  }

  public function transformacion(){
    return $this->belongsTo('App\Transformacion');
  }

  public function distribuciones(){
    return $this->belongsTo('App\Distribucion');
  }

  public function pu_final(){
    return $this->belongsTo('App\Pu_final');
  }

  public function municipio(){
    return $this->belongsTo('App\Municipio');
  }

  public function factura(){
    return $this->hasMany('App\Factura');
  }

  public function cuenta_cobro(){
    return $this->hasMany('App\Cuenta_cobro');
  }

  public function consignacion(){
    return $this->hasMany('App\Consignacion');
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
