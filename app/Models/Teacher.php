<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'teacher_id',
        'Nom',
        'Prenoms',
        'adresse',
        'Telephone',
        'email',
        'grade',
        'departement'

    ];
}
