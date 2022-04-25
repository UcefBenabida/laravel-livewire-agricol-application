<div>



        @if ( $rout == "http://" . $host . '/parcelles')
            @if ($mode_create)
                <div  class="create-crud-text">create new parcelle</div>
                <div class="center-align">
                    <input class="inp-crud" placeholder="nom de parcelle" type="text" wire:model="input.Par_Nom" />
                    <input class="inp-crud" placeholder="lieu de parcelle" type="text" wire:model="input.Par_Lieu" />
                    <input class="inp-crud" placeholder="nom du proprétaire de parcelle" type="text" wire:model="input.Par_Prop.nom" />
                    <input class="inp-crud" placeholder="prenom du proprétaire de parcelle" type="text" wire:model="input.Par_Prop.prenom" />
                    <input class="inp-crud" placeholder="supérfice de parcelle" type="text" wire:model="input.Par_Superficie" />
                </div>
                    
                <div class="center-align">
                    @if (!empty($message["Par_Nom"]) && !empty($input['Par_Nom']))
                    <div class="label-crud" style="color: {{ $color['Par_Nom'] }} ;" >{{ $message["Par_Nom"] }}</div>
                    @else
                        <div class="label-crud"  > </div>
                    @endif
                    @if (!empty($message["Par_Lieu"]) && !empty($input['Par_Lieu']))
                        <div class="label-crud" style="color: {{ $color['Par_Lieu'] }} ;" >{{ $message["Par_Lieu"] }}</div>
                    @else
                        <div class="label-crud"  > </div>
                    @endif
                    @if (!empty($message["Par_Prop"]['nom']) && !empty($input['Par_Prop']['nom']))
                        <div class="label-crud" style="color: {{ $color['Par_Prop']['nom'] }} ;" >{{ $message["Par_Prop"]['nom'] }}</div>
                    @else
                        <div class="label-crud"  > </div>
                    @endif
                    @if (!empty($message["Par_Prop"]['prenom']) && !empty($input['Par_Prop']['prenom']))
                    <div class="label-crud" style="color: {{ $color['Par_Prop']['prenom'] }} ;" >{{ $message["Par_Prop"]['prenom'] }}</div>
                    @else
                        <div class="label-crud"  > </div>
                    @endif
                    @if (!empty($message["Par_Superficie"]) && !empty($input['Par_Superficie']))
                        <div class="label-crud" style="color: {{ $color['Par_Superficie'] }} ;" >{{ $message["Par_Superficie"] }}</div>
                    @else
                        <div class="label-crud"  ></div>
                    @endif
                </div>

                <div class="center-align">
                    <button class="btn-crud" wire:click="save()" >save</button>
                    <button class="btn-crud" wire:click="cancel()" >cancel</button>
                </div>
                <br>
            @else
                <div class="center-align">
                    <button class="btn-crud" wire:click="modeCreate()" >create new parcelle</button>
                </div>
                <br>
            @endif
            
                
        @elseif ($rout == "http://" . $host . '/interventions')
            @if ($mode_create)
                <div  class="create-crud-text">create new intervention</div>
                <div class="center-align">
                    <input class="inp-crud" placeholder="nom de l'employe" type="text" wire:model="input.Int_Emp_Nss.nom" />
                    <input class="inp-crud" placeholder="prenom de l'employe" type="text" wire:model="input.Int_Emp_Nss.prenom" />
                    <input class="inp-crud" placeholder="nom de parcelle" type="text" wire:model="input.Int_Par_Id" />
                    <input class="inp-crud" placeholder="date débur d'intervention" type="date" wire:model="input.Int_Debut" />
                    <input class="inp-crud" placeholder="nombre de jours" type="number" wire:model="input.Int_Nb_Jours" />
                </div>
                    
                <div class="center-align">

                    @if (!empty($message["Int_Emp_Nss"]['nom']) && !empty($input['Int_Emp_Nss']['nom']))
                    <div class="label-crud" style="color: {{ $color['Int_Emp_Nss']['nom'] }} ;" >{{ $message["Int_Emp_Nss"]['nom'] }}</div>
                    @else
                        <div class="label-crud"  > </div>
                    @endif
                    @if (!empty($message["Int_Emp_Nss"]['prenom']) && !empty($input['Int_Emp_Nss']['prenom']))
                    <div class="label-crud" style="color: {{ $color['Int_Emp_Nss']['prenom'] }} ;" >{{ $message["Int_Emp_Nss"]['prenom'] }}</div>
                    @else
                        <div class="label-crud"  > </div>
                    @endif

                    @if (!empty($message["Int_Par_Id"]) && !empty($input['Int_Par_Id']))
                    <div class="label-crud" style="color: {{ $color['Int_Par_Id'] }} ;" >{{ $message["Int_Par_Id"] }}</div>
                    @else
                        <div class="label-crud"  > </div>
                    @endif
                    @if (!empty($message["Int_Debut"]) && !empty($input['Int_Debut']))
                        <div class="label-crud" style="color: {{ $color['Int_Debut'] }} ;" >{{ $message["Int_Debut"] }}</div>
                    @else
                        <div class="label-crud"  > </div>
                    @endif
                
                    @if (!empty($message["Int_Nb_Jours"]) && !empty($input['Int_Nb_Jours']))
                        <div class="label-crud" style="color: {{ $color['Int_Nb_Jours'] }} ;" >{{ $message["Int_Nb_Jours"] }}</div>
                    @else
                        <div class="label-crud"  ></div>
                    @endif
                </div>

                <div class="center-align">
                    <button class="btn-crud" wire:click="save()" >save</button>
                    <button class="btn-crud" wire:click="cancel()" >cancel</button>
                </div>
                <br>
            @else
                <div class="center-align">
                    <button class="btn-crud" wire:click="modeCreate()" >create new intervention</button>
                </div>
                <br>
            @endif
        @elseif ($rout == "http://" . $host . '/agriculteurs')
            @if ($mode_create)
            <div  class="create-crud-text">create new intervention</div>
            <div class="center-align">
                <input class="inp-crud" placeholder="nom de l'agriculteur" type="text" wire:model="input.Agr_Nom" />
                <input class="inp-crud" placeholder="prenom de l'agriculteur" type="text" wire:model="input.Agr_prn" />
                <input class="inp-crud" placeholder="résidance de l'agriculteur" type="text" wire:model="input.Agr_Resid" />
            </div>
                
            <div class="center-align">

                @if (!empty($message["Agr_Nom"]) && !empty($input['Agr_Nom']))
                <div class="label-crud" style="color: {{ $color['Agr_Nom'] }} ;" >{{ $message["Agr_Nom"] }}</div>
                @else
                    <div class="label-crud"  > </div>
                @endif
                @if (!empty($message["Agr_prn"]) && !empty($input['Agr_prn']))
                <div class="label-crud" style="color: {{ $color['Agr_prn'] }} ;" >{{ $message["Agr_prn"] }}</div>
                @else
                    <div class="label-crud"  > </div>
                @endif

                @if (!empty($message["Agr_Resid"]) && !empty($input['Agr_Resid']))
                <div class="label-crud" style="color: {{ $color['Agr_Resid'] }} ;" >{{ $message["Agr_Resid"] }}</div>
                @else
                    <div class="label-crud"  > </div>
                @endif
                
            </div>

            <div class="center-align">
                <button class="btn-crud" wire:click="save()" >save</button>
                <button class="btn-crud" wire:click="cancel()" >cancel</button>
            </div>
            <br>
            @else
                <div class="center-align">
                    <button class="btn-crud" wire:click="modeCreate()" >create new agriculteur</button>
                </div>
                <br>
            @endif
        @elseif ($rout == "http://" . $host . '/employes')
            @if ($mode_create)
            <div  class="create-crud-text">create new employe</div>
            <div class="center-align">
                <input class="inp-crud" placeholder="NSS de l'employe" type="number" min="100000000" wire:model="input.Emp_Nss" />
                <input class="inp-crud" placeholder="nom de l'employe" type="text" wire:model="input.Emp_Nom" />
                <input class="inp-crud" placeholder="prenom de l'employe" type="text" wire:model="input.Emp_Prenom" />
                <input class="inp-crud" placeholder="tarif sur l'employe" type="text" wire:model="input.Emp_Tarif" />
            </div>
                
            <div class="center-align">

                @if (!empty($message["Emp_Nss"]) && !empty($input['Emp_Nss']))
                <div class="label-crud" style="color: {{ $color['Emp_Nss'] }} ;" >{{ $message["Emp_Nss"] }}</div>
                @else
                    <div class="label-crud"  > </div>
                @endif
                @if (!empty($message["Emp_Nom"]) && !empty($input['Emp_Nom']))
                <div class="label-crud" style="color: {{ $color['Emp_Nom'] }} ;" >{{ $message["Emp_Nom"] }}</div>
                @else
                    <div class="label-crud"  > </div>
                @endif

                @if (!empty($message["Emp_Prenom"]) && !empty($input['Emp_Prenom']))
                <div class="label-crud" style="color: {{ $color['Emp_Prenom'] }} ;" >{{ $message["Emp_Prenom"] }}</div>
                @else
                    <div class="label-crud"  > </div>
                @endif

                @if (!empty($message["Emp_Tarif"]) && !empty($input['Emp_Tarif']))
                <div class="label-crud" style="color: {{ $color['Emp_Tarif'] }} ;" >{{ $message["Emp_Tarif"] }}</div>
                @else
                    <div class="label-crud"  > </div>
                @endif
                
            </div>

            <div class="center-align">
                <button class="btn-crud" wire:click="save()" >save</button>
                <button class="btn-crud" wire:click="cancel()" >cancel</button>
            </div>
            <br>
            @else
                <div class="center-align">
                    <button class="btn-crud" wire:click="modeCreate()" >create new employe</button>
                </div>
                <br>
            @endif
        @elseif ($rout == "http://" . $host . '/tarifs')
            @if ($mode_create)
            <div  class="create-crud-text">create new tarif</div>
            <div class="center-align">
                <input class="inp-crud" placeholder="description du tarif" type="text"  wire:model="input.Tar_Description" />
                <input class="inp-crud" placeholder="valeur du tarif" type="number" wire:model="input.Tar_Euro" />
            </div>
                
            <div class="center-align">

                @if (!empty($message["Tar_Description"]) && !empty($input['Tar_Description']))
                <div class="label-crud" style="color: {{ $color['Tar_Description'] }} ;" >{{ $message["Tar_Description"] }}</div>
                @else
                    <div class="label-crud"  > </div>
                @endif
                @if (!empty($message["Tar_Euro"]) && !empty($input['Tar_Euro']))
                <div class="label-crud" style="color: {{ $color['Tar_Euro'] }} ;" >{{ $message["Tar_Euro"] }}</div>
                @else
                    <div class="label-crud"  > </div>
                @endif

                
            </div>

            <div class="center-align">
                <button class="btn-crud" wire:click="save()" >save</button>
                <button class="btn-crud" wire:click="cancel()" >cancel</button>
            </div>
            <br>
            @else
                <div class="center-align">
                    <button class="btn-crud" wire:click="modeCreate()" >create new tarif</button>
                </div>
                <br>
            @endif
        @endif
</div>
