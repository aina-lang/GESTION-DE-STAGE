<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'Nom',
        'Prenoms',
        'Genre',
        'Age',
        'Adresse',
        'email',
        'Niveau',
        'Telephone',
        'upload',
    ];
    public function stage()
    {
        return $this->hasOne(Stage::class);
    }
}
