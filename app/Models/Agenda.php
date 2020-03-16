<?php

namespace App\Models;

class Agenda extends Model {

  protected $fillable = [ 'user_id', 'pacient_id', 'professional_id', 'date',
                          'duration', 'details'];
}