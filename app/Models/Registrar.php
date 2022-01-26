<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrar extends Authenticatable
{
    use HasFactory;
    protected $table = 'marcaciones';
}
