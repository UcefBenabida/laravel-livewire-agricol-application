



<div>



    <div class="section">

            
            <div>
                <button wire:click="showAgr()"  class="mr-btn btn">Agriculteurs ordonnées par nom</button>
            </div>
            <div>
                <button wire:click="showParce('superfice>500')" class="mr-btn btn">Liste des Parcelles dont la supérficie est > 500 </button>
            </div>
            <div>
                <button wire:click="showParce('Arith500>superfice>200')" class="mr-btn btn">List des Parcelles dont le lieu est Arith et 500 > superfice > 200</button>
            </div>
            <div>
                <button wire:click="showParce('ParcellesPropnoms')" class="mr-btn btn">les Parcelles et les noms de leurs proprétaires</button>
            </div>
            <div>
                <button wire:click="showIntervention('entre07-11-201et09-02-2012')" class="mr-btn btn">Interventions entre le 07-11-2011 et le 09-02-2012 </button>
            </div>


            <div>
                <button wire:click="showIntervention('intervetnomparcelle')"  class="mr-btn btn">Interventions et les noms des parcelles</button>
            </div>
            <div>
                <button wire:click="showIntervention('intervetparcellempl')" class="mr-btn btn">Interventions et parcelles et emps noms</button>
            </div>
            <div>
                <button wire:click="showIntervention('intervetdepemet')" class="mr-btn btn">Interventions de Pemet</button>
            </div>
            <div>
                <button wire:click="showParce('superficietotal')" class="mr-btn btn">La superficie totale des parcelles </button>
            </div>
            <div>
                <button wire:click="showParce('nomplusgrandeparcelle')" class="mr-btn btn">la plus grande parcelle</button>
            </div>

            <div>
                <button wire:click="showParce('nompluspetiteparcelle')" class="mr-btn btn">la plus petite parcelle</button>
            </div>
       
    </div>

    <div class="section"></div>

    <div class="divider"></div>
    <div class="section"></div>
    

    @switch($affichage)
    @case("agr")
        <div class="center-align z-depth-1"><b>la liste des noms des agriculteurs ordonnés selon leurs noms</b></div>
        <div class="row center-align z-depth-1">
            <b>Name</b>
        </div>
        @foreach ($agriculteurs_list as $name)
            <div class="row center-align z-depth-1">
                {{ $name }}
            </div>
        @endforeach
            @break
    @case("parce")
        <div class="center-align z-depth-1"><b>la liste Parcelles dont la supérfice est supérieur à 500</b></div>
        <div class="row center-align z-depth-1">
            <b>Name</b>
        </div>
        @foreach ($parcelles_list as $parce)
            <div class="row center-align z-depth-1">
                {{ $parce }}
            </div>
        @endforeach
            @break

    @case("parce2")
        <div class="center-align z-depth-1"><b>la liste Parcelles dont la supérfice est supérieur à 200 et inférier à 500 et son lieu à Arith</b></div>
        <div class="row center-align z-depth-1">
            <b class="col s1 m1 l1 xl1">Id</b>
            <b class="col s4 m4 l4 xl4">Name</b>
            <b class="col s3 m3 l3 xl3">Lieu</b>
            <b class="col s2 m2 l2 xl2">Prop</b>
            <b class="col s2 m2 l2 xl2">Supérfice</b>
            
        </div>
        @foreach ($parcelles_list as $parce)
            <div class="row center-align z-depth-1">
                <div class="col s1 m1 l1 xl1">{{ $parce->Par_Idf }}</div>
                <div class="col s4 m4 l4 xl4">{{ $parce->Par_Nom }}</div>
                <div class="col s3 m3 l3 xl3">{{ $parce->Par_Lieu }}</div>
                <div class="col s2 m2 l2 xl2">{{ $parce->Par_Prop }}</div>
                <div class="col s2 m2 l2 xl2">{{ $parce->Par_Superficie }}</div>
            </div>
        @endforeach
            @break

        @case("parce3")
        <div class="center-align z-depth-1"><b>la liste Parcelles avec les noms de leurs propriétaires</b></div>
        <div class="row center-align z-depth-1">
            <b class="col s1 m1 l1 xl1">Id</b>
            <b class="col s4 m4 l4 xl4">Name</b>
            <b class="col s3 m3 l3 xl3">Lieu</b>
            <b class="col s2 m2 l2 xl2">Propriétaires</b>
            <b class="col s2 m2 l2 xl2">Supérfice</b>
            
        </div>
        @foreach ($parcelles_list as $parce)
            <div class="row center-align z-depth-1">
                <div class="col s1 m1 l1 xl1">{{ $parce->Par_Idf }}</div>
                <div class="col s4 m4 l4 xl4">{{ $parce->Par_Nom }}</div>
                <div class="col s3 m3 l3 xl3">{{ $parce->Par_Lieu }}</div>
                <div class="col s2 m2 l2 xl2">{{ $parce->Par_Prop }}</div>
                <div class="col s2 m2 l2 xl2">{{ $parce->Par_Superficie }}</div>
            </div>
        @endforeach
            @break


        @case("intervent")
        <div class="center-align z-depth-1"><b>liste des interventions effectuées entre le 07-11-2011 et le 09-02-2012</b></div>
        <div class="row center-align z-depth-1">
            <b class="col s4 m4 l4 xl4">Int Emp Nss</b>
            <b class="col s2 m2 l2 xl2">Par Id</b>
            <b class="col s4 m4 l4 xl4">Int Debut</b>
            <b class="col s2 m2 l2 xl2">Int Nb Jours</b>
            
        </div>
        @foreach ($interventions_list as $interv)
            <div class="row center-align z-depth-1">
                <div class="col s4 m4 l4 xl4">{{ $interv->Int_Emp_Nss }}</div>
                <div class="col s2 m2 l2 xl2">{{ $interv->Int_Par_Id }}</div>
                <div class="col s4 m4 l4 xl4">{{ $interv->Int_Debut }}</div>
                <div class="col s2 m2 l2 xl2">{{ $interv->Int_Nb_Jours }}</div>
            </div>
        @endforeach
            @break


        @case("intervent2")
        <div class="center-align z-depth-1"><b>liste des interventions et les noms des parcelles </b></div>
        <div class="row center-align z-depth-1">
            <b class="col s4 m4 l4 xl4">Int Emp Nss</b>
            <b class="col s2 m2 l2 xl2">Nom Parcelle</b>
            <b class="col s4 m4 l4 xl4">Int Debut</b>
            <b class="col s2 m2 l2 xl2">Int Nb Jours</b>
            
        </div>
        @foreach ($interventions_list as $interv)
            <div class="row center-align z-depth-1">
                <div class="col s4 m4 l4 xl4">{{ $interv->Int_Emp_Nss }}</div>
                <div class="col s2 m2 l2 xl2">{{ $interv->Int_Par_Id }}</div>
                <div class="col s4 m4 l4 xl4">{{ $interv->Int_Debut }}</div>
                <div class="col s2 m2 l2 xl2">{{ $interv->Int_Nb_Jours }}</div>
            </div>
        @endforeach
            @break

        
        @case("intervetparcellempl")
        <div class="center-align z-depth-1"><b>liste des interventions et les noms des parcelles </b></div>
        <div class="row center-align z-depth-1">
            <b class="col s4 m4 l4 xl4">Int Emp Nss</b>
            <b class="col s2 m2 l2 xl2">Nom Parcelle</b>
            <b class="col s2 m2 l2 xl2">Nom Employé</b>
            <b class="col s4 m4 l4 xl4">Int Debut</b>
            <b class="col s2 m2 l2 xl2">Int Nb Jours</b>
            
        </div>
        @foreach ($interventions_list as $index => $interv)
            <div class="row center-align z-depth-1">
                <div class="col s4 m4 l4 xl4">{{ $interv->Int_Emp_Nss }}</div>
                <div class="col s2 m2 l2 xl2">{{ $interv->Int_Par_Id }}</div>
                <div class="col s2 m2 l2 xl2">{{ $emp_names[$index] }}</div>
                <div class="col s4 m4 l4 xl4">{{ $interv->Int_Debut }}</div>
                <div class="col s2 m2 l2 xl2">{{ $interv->Int_Nb_Jours }}</div>
            </div>
        @endforeach
            @break


        @case("intervetdepemet")
        <div class="center-align z-depth-1"><b>liste des interventions de l'employé Pemet </b></div>
        <div class="row center-align z-depth-1">
            <b class="col s4 m4 l4 xl4">Int Emp Nss</b>
            <b class="col s2 m2 l2 xl2">Par Id</b>
            <b class="col s4 m4 l4 xl4">Int Debut</b>
            <b class="col s2 m2 l2 xl2">Int Nb Jours</b>
            
        </div>
        @foreach ($interventions_list as $interv)
            <div class="row center-align z-depth-1">
                <div class="col s4 m4 l4 xl4">{{ $interv->Int_Emp_Nss }}</div>
                <div class="col s2 m2 l2 xl2">{{ $interv->Int_Par_Id }}</div>
                <div class="col s4 m4 l4 xl4">{{ $interv->Int_Debut }}</div>
                <div class="col s2 m2 l2 xl2">{{ $interv->Int_Nb_Jours }}</div>
            </div>
        @endforeach
            @break


        @case("superficietotal")
            
        <div class="center-align z-depth-1"><b>le superficie totale des parcelles</b></div>
        <div class="row center-align z-depth-1">{{ $total_superficie }}</div>

        @break



        @case("nomplusgrandeparcelle")
            
        <div class="center-align z-depth-1"><b>la plus grande parcelle</b></div>
        <div class="row center-align z-depth-1">{{ $grande_parcelle }}</div>

        @break


        @case("nompluspetiteparcelle")
            
        <div class="center-align z-depth-1"><b>la plus petite parcelle</b></div>
        <div class="row center-align z-depth-1">{{ $petite_parcelle }}</div>

        @break



    @default
@endswitch


</div>

   
