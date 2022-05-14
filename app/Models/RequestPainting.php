<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Este modelo simplemnte recoge los datos enviados por el formulario
 * por si hay algún problema con el correo electrónico
 */
class RequestPainting extends Model
{
    use HasFactory;
}
