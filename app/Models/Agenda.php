<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model {

  protected $fillable = [ 'user_id', 'pacient_id', 'professional_id', 'date',
                          'details'];
}