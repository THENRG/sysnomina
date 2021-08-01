<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class PreNomina extends Model
{
    use HasFactory;

    protected $fillable = [
        'dpto', 'dates', 'info'
    ];

     protected $casts = [
        'info' => 'array',
    ]; 
}
