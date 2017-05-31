<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
  protected $table = 'clientes';

  protected $fillable = ['id','nit','cedula','nombre','contacto','telefono','direccion','email','departamento_id','municipio'];

  public $timestamps = false;

    public function administrativa(){
      return $this->hasMany('App\Administrativa');
    }
    
    public function departamento(){
      return $this->belongsTo('App\Departamento');
    }
}
