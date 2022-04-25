<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agriculteur extends Model
{
    use HasFactory;

    protected $primaryKey = 'Agr_Id';


    protected $fillable = [
        'Agr_Id',
        'Agr_Nom',
        'Agr_prn',
        'Agr_Resid',
    ];
}
