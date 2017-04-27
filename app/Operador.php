<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Operador extends Authenticatable
{
   use Notifiable;

  protected $table = 'operador';

  protected $primaryKey = 'id';

  protected $fillable = ['id','user','password'];

  public $timestamps = false;
}
