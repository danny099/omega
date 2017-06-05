<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
  protected $table = 'audits';

  protected $fillable = ['id','user_id','auditable_id','auditable_type','old_values','new_values','url','ip_address','user_agent','create_at'];

  public $timestamps = false;


}
