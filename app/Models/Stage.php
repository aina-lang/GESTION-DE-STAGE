<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'partenaire_id',
        'teacher_id',
        'theme',
        'start_date',
        'end_date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function partenaire()
    {
        return $this->belongsTo(Partenaire::class, 'partenaire_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
