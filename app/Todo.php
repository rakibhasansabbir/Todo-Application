<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Manager;

class Todo extends Model
{
    public function manager()
  {
      return $this->belongsTo('App\Manager');
  }
}
