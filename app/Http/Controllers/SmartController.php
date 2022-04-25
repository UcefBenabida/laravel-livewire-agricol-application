<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SmartController extends Controller
{
    //



    public function shortsRequest()
    {
            // The user is logged in...

            /*if (Gate::allows('isAdmin')) {

                dd('Admin allowed');
        
            } else {
        
                dd('You are not Admin');
        
            }*/
            return view('livewire.home');

       
    }

}
