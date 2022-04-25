<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcelle extends Model
{
    use HasFactory;

    protected $primaryKey = 'Par_Idf';


    protected $fillable = [
        'Par_Idf',
        'Par_Nom',
        'Par_Lieu',
        'Par_Prop',
        'Par_Superficie',
       

    ];
    
}
