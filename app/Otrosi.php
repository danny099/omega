<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Otrosi extends Model
{
  protected $table = 'otrosi';

  protected $fillable = ['id','valor','administrativa_id'];

  public $timestamps = false;

  public function administrativa(){
    return $this->hasMany('App\Administrativa');
  }
}
