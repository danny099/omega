<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Illuminate\Support\Arr;

class Autorizacion extends Model
{
	  // use Auditable;
	  protected $table = 'Autorizacion';

	  protected $fillable = ['id','autorizado','firma','observaciones','fecha','administrativa_id','cantidad_autorizada_id'];

	  public $timestamps = false;

	  public function administrativa(){
      	return $this->hasMany('App\Administrativa');
      }

      public function cantidad_autorizadas(){
      	return $this->hasMany('App\Cantidad_autorizada');
      }
    
}
