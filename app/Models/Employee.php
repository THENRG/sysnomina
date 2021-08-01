<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cargo;
use App\Models\Asistencia;


class Employee extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'genero', 'contacto', 'profesion', 'fecha_nacimiento', 'direccion', 'rif', 'cargo', 'dpto', 'horario'
    ];

    public function getHorario()
    {
        return $this->horario;
    }

    public function getSalario()
    {
        $query = Cargo::where('name', $this->cargo)->first();
        return $query->salary;
    }

    public function isTarde()
    {
        $hr = explode(" - ", $this->horario);
        $diffe = strtotime($hr[0]) - strtotime($request->hr_in);
        $diff_in_min = $diffe/3600;               

        if (round($diff_in_min) < 0) {
            return true; 
        }
    }

   public function isTemprano()
    {
        $hr = explode(" - ", $this->horario);
        $diffe = strtotime($hr[0]) - strtotime($request->hr_in);
        $diff_in_min = $diffe/3600;               

        if (round($diff_in_min) > 0) {
            return true; 
        }
    }

    public function getSalida()
    {
        $query = Employee::where('name', $this->cargo)->first();

        return $query->salary;
    }
}
