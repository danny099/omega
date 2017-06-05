<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Operador extends Authenticatable implements AuditableContract
{
  use Auditable;
  use Notifiable;

  protected $table = 'operador';

  protected $primaryKey = 'id';

  protected $fillable = ['id','user','password'];

  public $timestamps = false;
}
