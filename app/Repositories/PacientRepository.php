<?php

namespace App\Repositories;

use App\Models\Pacient;
use App\Models\User;

class PacientRepository {

    public function storePacient($data){
      $user_data = [
          'name'          => $data['name'],
          'email'         => $data['email'],
          'password'      => bcrypt($data['password']),
          'permission'    => 'pacient'
      ];
      $user = (new User)->create($user_data);

      $info = [
        'user_id' => $user->id,
        'cpf'     => $data['cpf']
      ];
      return (new Pacient)->create($info);
    }
}