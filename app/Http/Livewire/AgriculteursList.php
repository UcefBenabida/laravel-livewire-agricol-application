<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Agriculteur;
use App\Models\Parcelle;
use App\Models\Intervention;
use App\Models\Employe;
use Illuminate\Support\Facades\DB;





class AgriculteursList extends Component
{

    public $all_parcelles;
    public $all_interventions;

    public $affichage = "test";
    public $test = "";

    public $agriculteurs_list = [] ;
    public $parcelles_list = [] ;
    public $interventions_list = [];
    public $emp_names = [];

    public $total_superficie = 0;
    public $grande_parcelle;
    public $petite_parcelle;


    public function render()
    {    

        return view('livewire.agriculteurs-list');
    }

    public function showAgr()
    {
        $this->affichage = "agr";

        $names = [];
        $all_agriculteurs = DB::table('agriculteurs')->get();
        foreach( $all_agriculteurs as $index => $agri)
        {
            $names[] = $agri->Agr_Nom ;
        }
        sort($names);
        $this->agriculteurs_list = $names;
        
    }

    public function showParce($condition)
    {
        $ordored_list = [];
        $not_ordored_list = [];

        $all_parcelles = DB::table('parcelles')->get();

        switch($condition)
        {
            case "superfice>500":
                $this->affichage = "parce";

                foreach($all_parcelles as $parce)
                {
                    if($parce->Par_Superficie > 500)
                    {
                        $ordored_list[] = $parce->Par_Nom; 
                    }
                }
                $this->parcelles_list = $ordored_list;
                break;

            case "Arith500>superfice>200":
                $this->affichage = "parce2";

                $all_parcelles = DB::table('parcelles')->get();

                foreach($all_parcelles as $parce)
                {
                    if($parce->Par_Lieu == "Arith" && 500 > $parce->Par_Superficie && $parce->Par_Superficie > 200)
                    {
                        $ordored_list[] = $parce; 
                    }
                }
                $this->parcelles_list = $ordored_list;
                break;

            case "ParcellesPropnoms":
                $this->affichage = "parce3";
                
                $all_parcelles = DB::table('parcelles')->get();

                $all_agriculteurs = DB::table('agriculteurs')->get();

                foreach($all_parcelles as $index => $parce)
                {
                    foreach($all_agriculteurs as $agr)
                    {
                        if($parce->Par_Prop == $agr->Agr_Id)
                        {
                            $all_parcelles[$index]->Par_Prop = $agr->Agr_Nom; 
                        }
                    }
                }
                $this->parcelles_list = $all_parcelles;
                break;

            case "superficietotal":

                $this->affichage = "superficietotal";

                $all_parcelles = DB::table('parcelles')->get();

                $super_totale = 0;

                foreach($all_parcelles as $parce)
                {
                    $super_totale += $parce->Par_Superficie;
                }

                $this->total_superficie = $super_totale;

                break;


            case "nomplusgrandeparcelle":

                $this->affichage = "nomplusgrandeparcelle";

                $all_parcelles = DB::table('parcelles')->get();
                $all_interventions = DB::table('interventions')->get();

                $date_max = date_create($all_interventions[0]->Int_Debut);
                $name_max;

                foreach($all_parcelles as $parce)
                {
                    if($parce->Par_Idf == $all_interventions[0]->Int_Par_Id)
                    {
                        $name_max = $parce->Par_Nom;
                    }
                }
                //$name_max = $not_ordored_list[0]->Int_Debut;
                $date_test;

                foreach($all_interventions as $interv)
                {
                    $date_test = date_create($interv->Int_Debut);

                    if($date_test > $date_max)
                    {
                        $date_max = $date_test;
                        foreach($all_parcelles as $parce)
                        {
                            if($parce->Par_Idf == $interv->Int_Par_Id)
                            {
                                $name_max = $parce->Par_Nom;
                                break;
                            }
                        }
                    }
                }

                $this->grande_parcelle = $name_max;

                break;
            
                

                case "nompluspetiteparcelle":


                    $this->affichage = "nompluspetiteparcelle";

                    $all_parcelles = DB::table('parcelles')->get();
                    $all_interventions = DB::table('interventions')->get();
    
                    $date_min = date_create($all_interventions[0]->Int_Debut);
                    $name_min;
    
                    foreach($all_parcelles as $parce)
                    {
                        if($parce->Par_Idf == $all_interventions[0]->Int_Par_Id)
                        {
                            $name_min = $parce->Par_Nom;
                        }
                    }
                    $date_test;
    
                    foreach($all_interventions as $interv)
                    {
                        $date_test = date_create($interv->Int_Debut);
    
                        if($date_test < $date_min)
                        {
                            $date_min = $date_test;
                            foreach($all_parcelles as $parce)
                            {
                                if($parce->Par_Idf == $interv->Int_Par_Id)
                                {
                                    $name_min = $parce->Par_Nom;
                                    break;
                                }
                            }
                        }
                    }
    
                    $this->petite_parcelle = $name_min;
    

                    break;


            default:
                $this->test = "hellow!";
                break;




        }
        
    }

    public function showIntervention($condition)
    {
        

        $not_ordored_list = [];
        $ordored_list = [];

        $date1=date_create("2011-11-07");
        $date2=date_create("2012-02-09");
        $date_test ;

        switch($condition)
        {
        
            case 'entre07-11-201et09-02-2012':
                $all_interventions = DB::table('interventions')->get();
                $this->affichage = "intervent";
                foreach($all_interventions as $interv)
                {
                    $date_test = date_create($interv->Int_Debut);
                    date_add($date_test,date_interval_create_from_date_string(strval($interv->Int_Nb_Jours)." days"));

                    if($date2 > $date_test && $date_test > $date1)
                    {
                        $ordored_list[] = $interv;
                    }
                }

                $this->interventions_list = $ordored_list;
                    break;
                

            case 'intervetnomparcelle':
                $this->affichage = "intervent2";
                $all_interventions = DB::table('interventions')->get();
                $all_parcelles = DB::table('parcelles')->get();
                foreach($all_interventions as $index => $interv) 
                {
                    foreach($all_parcelles as $parce)
                    {
                        if((int)$interv->Int_Par_Id == $parce->Par_Idf )
                        {
                            $all_interventions[$index]->Int_Par_Id = $parce->Par_Nom;
                        }
                    }
                }
                $this->interventions_list = $all_interventions;
                    break;
            
            case "intervetparcellempl":

                $this->affichage = "intervetparcellempl";

                $all_interventions = DB::table('interventions')->get();
                $all_parcelles = DB::table('parcelles')->get();
                $all_employes = DB::table('employes')->get();
                $emps_names = [];

                foreach($all_interventions as $index => $interv)
                {
                    foreach($all_parcelles as $parce)
                    {
                        if((int)$interv->Int_Par_Id == $parce->Par_Idf)
                        {
                            $all_interventions[$index]->Int_Par_Id = $parce->Par_Nom;
                            
                            break;
                        }
                    }


                    foreach($all_employes as $emp)
                    {
                        if($emp->Emp_Nss == $interv->Int_Emp_Nss)
                        {
                            $emps_names[$index] = $emp->Emp_Nom;
                            break;

                        }
                    }
                }

                $this->emp_names = $emps_names;
                $this->interventions_list = $all_interventions;

                break;

            case "intervetdepemet":

                $this->affichage = "intervetdepemet";

                $all_interventions = DB::table('interventions')->get();
                $all_employes = DB::table('employes')->get();
                $ordored_list = [];

                foreach($all_interventions as $interv)
                {
                    foreach($all_employes as $emp)
                    {
                        if($emp->Emp_Nom == "Pemet" && $emp->Emp_Nss == $interv->Int_Emp_Nss)
                        {
                            $ordored_list[] = $interv;
                            break;

                        }
                    }
                }

                $this->interventions_list = $ordored_list;

                break;


        }

        

    }
}
