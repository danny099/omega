<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Illuminate\Support\Arr;
class Documento extends Model implements AuditableContract
{
  use Auditable;
  protected $table = 'documentos';
  protected $fillable = ['id','nombre','detalles','tipo','created_at','updated_at'];

}
