<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuarios extends Authenticatable
{
    use Notifiable;

    // Es para el trabajador

        protected $table = 'usuarios';
        protected $guard = 'usuarios';
        protected $primaryKey = 'usua_codi';
        protected $fillable = [
            'usua_nomb', 'usua_email', 'usua_pasw',
        ];

        protected $hidden = [
            'usua_pasw', 'remember_token',
        ];
        
}
