<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\Asistencia;
use Carbon\Carbon; 

class Departamento extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'encargado'];

    public function getEmployees()
    {
        $query = Employee::where('dpto', $this->name)->get();
        return $query;
    }

    public function getAsistencias()
    {
        $all = Employee::where('dpto', $this->name)->get();
        $date = Carbon::now();
        $employees = [];
        foreach ($all as $employee) {
            if ($employee->dpto == $this->name) {
                if ($employee->name == $this->employee) {
                    
                    $asistencia = Asistencia::where('employee', $employee->name)->first();
                    if ($asistencia) {
                        return "$asistencia";
                        $dt = $date->toFormattedDateString();
                        if ($dt == $asistencia->date) {

                            
                        }
                    }
                }
            }
        }
    }

}
