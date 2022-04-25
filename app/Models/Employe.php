<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    protected $primaryKey = 'Emp_Nss';


    protected $fillable = [
        'Emp_Nss',
        'Emp_Nom',
        'Emp_Prenom',
        'Emp_Tarif',
    ];
}
