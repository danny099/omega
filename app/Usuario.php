<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Contracts\UserResolver;

use Illuminate\Database\Eloquent\Model;



class Usuario extends Authenticatable implements AuditableContract
{
  use Notifiable;
  use Auditable;
  protected $table = 'usuarios';

  protected $fillable = ['id','cedula','nombres','apellidos','email','password','rol_id'];

  public $timestamps = false;

  public static function resolveId()
{
    return Auth::check() ? Auth::user()->nombres : null;
}

  public function roles(){
    return $this->belongsTo('App\Rol', 'rol_id');
  }

  /**
   * Ingreso belongs to many (many-to-many) Elemento.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function administrativa()
  {
    // belongsToMany(RelatedModel, pivotTable, thisKeyOnPivot = ingreso_id, otherKeyOnPivot = elemento_id)
    return $this->belongsToMany(Administrativa::class,'usuario_administrativa','usuario_id','administrativa_id');
  }





}
