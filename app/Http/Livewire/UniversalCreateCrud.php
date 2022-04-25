<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;


class UniversalCreateCrud extends Component
{

    public $parcelle_name;
    public $parcelle_place;
    public $parcelle_prop;
    public $parcelle_superfice;
    public $input = [];
    public $message = [];
    public $rout_name;
    public $rout ;
    public $host;
    public $color;
    public $mode_create = false;
    public $table;

    public function render()
    {
            $this->rout = apache_request_headers()["Referer"] ;
            $this->host = apache_request_headers()["Host"] ;
            switch($this->rout)
            {
                case "http://" . $this->host . '/parcelles':
                    $this->table = "parcelles";
                    break;
                case "http://" . $this->host . '/interventions':
                    $this->table = "interventions";
                    break;
                case "http://" . $this->host . '/agriculteurs':
                    $this->table = "agriculteurs";
                    break;
                case "http://" . $this->host . '/employes':
                    $this->table = "employes";
                    break;
                case "http://" . $this->host . '/tarifs':
                    $this->table = "tarifs";
                    break;
            }

        $this->manageInputs();

        return view('livewire.universal-create-crud');
    }

    public function manageInputs($ask=false)
    {
        $par_prop ;
        $test=true;

        switch($this->table)
        {
            case "parcelles":

                if(isset($this->input['Par_Prop']) && isset($this->input['Par_Prop']['nom']) && $this->input['Par_Prop']['nom'] != null  && isset($this->input['Par_Prop']['prenom']) && $this->input['Par_Prop']['prenom'] != null)
                {
                    $par_prop= DB::table('agriculteurs')->where('Agr_Nom', $this->input['Par_Prop']['nom'])->where('Agr_prn', $this->input['Par_Prop']['prenom'])->first();  

                    if($par_prop != null)
                    {
                        $this->message['Par_Prop']['nom'] = "nom du proprétaire du parcelle correcte" ;
                        $this->message['Par_Prop']['prenom'] = "prenom du proprétaire du parcelle correcte" ;

                        $this->color['Par_Prop']['nom'] = "green";
                        $this->color['Par_Prop']['prenom'] = "green";

                        $test = true;
                    }
                    else
                    {
                        $this->message['Par_Prop']['nom']  = "nom du proprétaire du parcelle n'existe pas" ;
                        $this->message['Par_Prop']['prenom']  = "prenom du proprétaire du parcelle n'existe pas" ;

                        $this->color['Par_Prop']['nom']  = "red";
                        $this->color['Par_Prop']['prenom']  = "red";

                        $test = false;
                    }
                }

                if(isset($this->input['Par_Nom']) && $this->input['Par_Nom'] != null)
                {
                    if($this->isValideName($this->input['Par_Nom']))
                    {
                        $result = DB::table('parcelles')->where('Par_Nom', $this->input['Par_Nom'])->first();  
                        if($result != null)
                        {
                            $this->message['Par_Nom'] = "nom de parcelle déjas utilisé" ;
                            $this->color['Par_Nom'] = "red";
                            $test = false;
                        }
                        else
                        {
                            $this->message['Par_Nom'] = "nom de parcelle est disponible" ;
                            $this->color['Par_Nom'] = "green";
                            $test = true;
                        }
                    }
                    else
                    {
                        $this->message['Par_Nom'] = "nom de parcelle doit être alphanumérique" ;
                        $this->color['Par_Nom'] = "red";
                        $test = false;
                    }
                
                }

                if(isset($this->input['Par_Superficie']) && $this->input['Par_Superficie'] != null)
                {
                    if(is_numeric($this->input['Par_Superficie']))
                    {
                        
                            $this->message['Par_Superficie'] = "superficie valide" ;
                            $this->color['Par_Superficie'] = "green";
                            $test = true;
                    }
                    else
                    {
                        $this->message['Par_Superficie'] = "superficie non valide" ;
                        $this->color['Par_Superficie'] = "red";
                        $test = false;
                    }
                
                }

                break;

            case "interventions":

                if(isset($this->input['Int_Emp_Nss']) && isset($this->input['Int_Emp_Nss']['nom']) && $this->input['Int_Emp_Nss']['nom'] != null  && isset($this->input['Int_Emp_Nss']['prenom']) && $this->input['Int_Emp_Nss']['prenom'] != null)
                {
                    $par_prop= DB::table('employes')->where('Emp_Nom', $this->input['Int_Emp_Nss']['nom'])->where('Emp_Prenom', $this->input['Int_Emp_Nss']['prenom'])->first();  

                    if($par_prop != null)
                    {
                        $this->message['Int_Emp_Nss']['nom'] = "nom du proprétaire du parcelle correcte" ;
                        $this->message['Int_Emp_Nss']['prenom'] = "prenom du proprétaire du parcelle correcte" ;

                        $this->color['Int_Emp_Nss']['nom'] = "green";
                        $this->color['Int_Emp_Nss']['prenom'] = "green";

                        $test = true;
                    }
                    else
                    {
                        $this->message['Int_Emp_Nss']['nom']  = "nom du proprétaire du parcelle n'existe pas" ;
                        $this->message['Int_Emp_Nss']['prenom']  = "prenom du proprétaire du parcelle n'existe pas" ;

                        $this->color['Int_Emp_Nss']['nom']  = "red";
                        $this->color['Int_Emp_Nss']['prenom']  = "red";

                        $test = false;
                    }
                }

                if(isset($this->input['Int_Par_Id']) && $this->input['Int_Par_Id'] != null)
                {
                    $result = DB::table('parcelles')->where('Par_Nom', $this->input['Int_Par_Id'])->first();  
                    if($result != null)
                    {
                        $this->message['Int_Par_Id'] = "nom de parcelle correct" ;
                        $this->color['Int_Par_Id'] = "green";
                        $test = false;
                    }
                    else
                    {
                        $this->message['Int_Par_Id'] = "nom de parcelle n'est pas correct" ;
                        $this->color['Int_Par_Id'] = "red";
                        $test = true;
                    }
                
                }

                if(isset($this->input['Int_Nb_Jours']) && $this->input['Int_Nb_Jours'] != null)
                {
                    if(is_numeric($this->input['Int_Nb_Jours']))
                    {
                        
                            $this->message['Int_Nb_Jours'] = "superficie valide" ;
                            $this->color['Int_Nb_Jours'] = "green";
                            $test = true;
                    }
                    else
                    {
                        $this->message['Int_Nb_Jours'] = "superficie non valide" ;
                        $this->color['Int_Nb_Jours'] = "red";
                        $test = false;
                    }
                
                }

                break;

            case "agriculteurs":

                if(isset($this->input['Agr_Nom']) && $this->input['Agr_Nom'] != null && isset($this->input['Agr_prn']) && $this->input['Agr_prn'] != null)
                {
                    $par_prop= DB::table('agriculteurs')->where('Agr_Nom', $this->input['Agr_Nom'])->where('Agr_prn', $this->input['Agr_prn'])->first();  

                    if($par_prop != null)
                    {
                        $this->message['Agr_Nom'] = "nom d'agriculteur déjas utilisé ou" ;
                        $this->message['Agr_prn'] = "prenom d'agriculteur déjas utilisé" ;

                        $this->color['Agr_Nom'] = "red";
                        $this->color['Agr_prn'] = "red";

                        $test = false;
                    }
                    else
                    {
                        $this->message['Agr_Nom']  = "nom d'agriculteur est disponible" ;
                        $this->message['Agr_prn']  = "prenom d'agriculteur est disponible" ;

                        $this->color['Agr_Nom']  = "green";
                        $this->color['Agr_prn']  = "green";

                        $test = true;
                    }
                }

                if(isset($this->input['Agr_Resid']) && $this->input['Agr_Resid'] != null)
                {
                    if($this->isValideName($this->input['Agr_Resid']))
                    {
                        $this->message['Agr_Resid'] = "écriture correcte" ;
                        $this->color['Agr_Resid'] = "green";
                        $test = true;
                }
                    else
                    {
                        $this->message['Agr_Resid'] = "écriture n'est pas correcte" ;
                        $this->color['Agr_Resid'] = "red";
                        $test = false;
                    }
                
                }

                
                break;

            case "employes":

                if(isset($this->input['Emp_Nss']) && $this->input['Emp_Nss'] != null)
                {
                    $par_prop= DB::table('employes')->where('Emp_Nss', $this->input['Emp_Nss'])->first();  

                    if($par_prop != null)
                    {
                        $this->message['Emp_Nss']['nom'] = "NSS n'est disponible" ;

                        $this->color['Emp_Nss']['nom'] = "red";

                        $test = true;
                    }
                    else
                    {
                        $this->message['Par_Prop']['nom']  = "NSS disponible" ;

                        $this->color['Par_Prop']['prenom']  = "green";

                        $test = false;
                    }
                }

                if(isset($this->input['Emp_Nom']) && $this->input['Emp_Nom'] != null)
                {
                    if($this->isValideName($this->input['Emp_Nom']))
                    {
                        $this->message['Emp_Nom'] = "nom corrcet" ;
                        $this->color['Emp_Nom'] = "green";
                        $test = true;
                    }
                    else
                    {
                        $this->message['Par_Nom'] = "nom n'est pas correct" ;
                        $this->color['Par_Nom'] = "red";
                        $test = false;
                    }
                
                }

                if(isset($this->input['Emp_Prenom']) && $this->input['Emp_Prenom'] != null)
                {
                    if($this->isValideName($this->input['Emp_Prenom']))
                    {
                        $this->message['Emp_Prenom'] = "prenom corrcet" ;
                        $this->color['Emp_Prenom'] = "green";
                        $test = true;
                    }
                    else
                    {
                        $this->message['Emp_Prenom'] = "prenom n'est pas correct" ;
                        $this->color['Emp_Prenom'] = "red";
                        $test = false;
                    }
                
                }

                if(isset($this->input['Emp_Tarif']) && $this->input['Emp_Tarif'] != null)
                {
                    $par_prop= DB::table('tarifs')->where('Tar_Description', $this->input['Emp_Tarif'])->first();  
                    if($par_prop != null)
                    {
                        $this->message['Emp_Tarif'] = "tarif valide" ;
                        $this->color['Emp_Tarif'] = "green";
                        $test = true;
                    }
                    else
                    {
                        $this->message['Emp_Tarif'] = "tarif non valide" ;
                        $this->color['Emp_Tarif'] = "red";
                        $test = false;
                    }
                
                }

                break;

                case "tarifs":

                    if(isset($this->input['Tar_Description']) && $this->input['Tar_Description'] != null)
                    {
                        $par_prop= DB::table('tarifs')->where('Tar_Description', $this->input['Tar_Description'])->first();  
    
                        if($par_prop != null)
                        {
                            $this->message['Tar_Description'] = "description de tarif n'est pas disponible" ;
    
                            $this->color['Tar_Description'] = "red";
    
                            $test = false;
                        }
                        else
                        {
                            $this->message['Tar_Description']  = "description de est disponible" ;
    
                            $this->color['Tar_Description']  = "green";
    
                            $test = true;
                        }
                    }

                    
                    break;
    
            
        }

        if($ask)
        {
            return $test;
        }
    }

    public function save()
    {
        $req = [];
        $prop_id ;

        if($this->manageInputs(true))
        {
            foreach($this->input as $column => $value)
            {
                switch($this->table)
                {
                    case "parcelles":
                        if($column == "Par_Prop")
                        {
                            $prop_id = DB::table("agriculteurs")->where("Agr_Nom", $value['nom'])->where("Agr_prn", $value['prenom'])->value('Agr_Id');
                            $req += [$column => $prop_id];
                        }
                        else
                        {
                            $req += [$column => $value];
                        }
                        break;

                    case "interventions":
                        if($column == "Int_Emp_Nss")
                        {
                            $prop_id = DB::table("employes")->where("Emp_Nom", $value['nom'])->where("Emp_Prenom", $value['prenom'])->value('Emp_Nss');
                            $req += [$column => $prop_id];
                        }
                        else
                        {
                            if($column == "Int_Par_Id")
                            {
                                $prop_id = DB::table("parcelles")->where("Par_Nom", $value)->value('Par_Idf');
                                $req += [$column => $prop_id];
                            }
                            else
                            {
                                $req += [$column => $value];
                            }
                        }
                        break;
                    
                    default:
                        $req += [$column => $value];
                        break;
                    
                    
                }
            }
    
            DB::table($this->table)->insert($req);
            $this->input = [];
        }
       
    }

    public function modeCreate()
    {
        $this->mode_create = true;
    }

    public function cancel()
    {
        $this->mode_create = false;
    }

    public function isValideName($name)
    {
        foreach(str_split($name) as $c)
        {
            if(!ctype_alnum($c) && $c != " " )
            {
                return false;
            }
        }
        return true;
    }
}
