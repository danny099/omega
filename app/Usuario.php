<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Contracts\UserResolver;
use Illuminate\Support\Arr;
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
      $datos1 = Auth::user()->nombres;
      $datos2 = Auth::user()->apellidos;
      $datos3 = $datos1." ".$datos2;

      return Auth::check() ? $datos3 : null;

    }

    public function transformAudit(array $data)
    {
        if (Arr::has($data, 'auditable_id')) {
            Arr::set($data, 'auditable_id',  $this->cedula);
        }

        return $data;
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
