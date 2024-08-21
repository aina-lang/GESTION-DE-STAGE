<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    // La table associée au modèle
    protected $table = 'departments';

    // Les attributs qui peuvent être attribués en masse
    protected $fillable = [
        'name',
        'description',
    ];

    // Définir la relation avec les étudiants
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    // Définir la relation avec les enseignants
    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

    public function stages()
    {
        return $this->hasMany(Stage::class);
    }
}
