<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
  protected $table = 'audits';

  protected $fillable = ['id','event','user_id','auditable_id','auditable_type','old_values','new_values','url','ip_address','user_agent','created_at'];

  public $timestamps = false;


}
