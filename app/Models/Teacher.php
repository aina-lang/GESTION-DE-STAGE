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
        'department_id',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function stages()
    {
        return $this->hasMany(Stage::class, 'teacher_id');
    }
}
