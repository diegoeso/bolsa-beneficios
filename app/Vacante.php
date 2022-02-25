<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacante extends Model
{
    protected $table = 'postulados';

    protected $fillable = [
        'nombre',
        'apellidos',
        'telefono',
        'correo',
        'oficina',
        'motivo',
        'nivel_academico',
        'turismo',
        'laboral',
        'puesto',
        'descripcion'
    ];
}
