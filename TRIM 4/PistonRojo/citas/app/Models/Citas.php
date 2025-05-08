<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citas extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'citas';

    /**
     * Llave primaria de la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Campos que se pueden asignar de forma masiva.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'tipo_documento',
        'numero_documento',
        'tipo_servicio',
        'dia',
        'hora',
    ];

    /**
     * Tipos de datos de las columnas.
     *
     * @var array
     */
    protected $casts = [
        'dia' => 'date', // Automáticamente se convierte a Carbon
        'hora' => 'datetime:H:i', // Convierte a Carbon con formato específico
    ];

    /**
     * Relación con el usuario que crea la cita (si aplica).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
