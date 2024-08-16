<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
    use HasFactory;

    protected $table = 'partenaires';


    protected $primaryKey = 'id';


    public $incrementing = true;

    protected $fillable = [
        'nom',
        'email',
        'telephone',
        'adresse',
        'secteur',
    ];


    protected $hidden = [];


    protected $casts = [];

    public function stages()
    {
        return $this->hasMany(Stage::class);
    }
}
