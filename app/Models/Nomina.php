<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use DB;

class Nomina extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee', 'dates', 'info'
    ];

     protected $casts = [
        'info' => 'array',
    ];
}
