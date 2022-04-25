<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    use HasFactory;

    //protected $primaryKey = ['Int_Emp_Nss', 'Int_Par_Id'];

    protected $fillable = [
        'Int_Emp_Nss',
        'Int_Par_Id',
        'Int_Debut',
        'Int_Nb_Jours'
    ];
}
