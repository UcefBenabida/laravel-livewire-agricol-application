<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Intervention;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;


class InterventionTable extends DataTableComponent
{
    protected $model = Intervention::class;

    public $edit_mode = false;
    public $id_rows_to_edit = [];
    public $new_values = [];


    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function bulkActions(): array
    {
        if(Gate::allows('isEditor') || Gate::allows('isAdmin'))
        {
            if(!$this->edit_mode)
            {
                return [
                    'deleteAll' => 'delete',
                    'modeEditForRows' => 'edit',
                ];
            }
            else
            {
                return [
                    'deleteAll' => 'delete',
                    'modeEditForRows' => 'edit',
                    'closeEdiMode' => 'close edit mode',
                ];
            }
        }
        else
        {
            return [];
        }
    }

    public function columns(): array
    {
        return [
           
                Column::make("Id", "id")
                    ->searchable()
                    ->sortable(),
                Column::make("Emp NSS", "Int_Emp_Nss")
                    ->searchable()
                    ->format(
                        fn($value, $row, Column $column) => $this->rowsToEdit($row, $value, "Int_Emp_Nss")
                    ) ->html()
                    ->sortable(),
                Column::make("Parcelle Id", "Int_Par_Id")
                    ->searchable()
                    ->format(
                        fn($value, $row, Column $column) => $this->rowsToEdit($row, $value, "Int_Par_Id")
                    ) ->html()
                    ->sortable(),
                Column::make("Debut", "Int_Debut")
                    ->format(
                        fn($value, $row, Column $column) => $this->rowsToEdit($row, $value, "Int_Debut") 
                    ) ->html()
                    ->sortable(),
                Column::make("Nombre de jours", "Int_Nb_Jours")
                    ->format(
                        fn($value, $row, Column $column) => $this->rowsToEdit($row, $value, "Int_Nb_Jours")
                    ) ->html()
                    ->sortable(),
                Column::make("Created at", "created_at")
                    ->sortable(),
                Column::make("Updated at", "updated_at")
                    ->sortable(),
                
        ];
    }

    public function closeEdiMode()
    {
        $this->edit_mode = false;
        $this->new_values = [];
        $this->id_rows_to_edit = [];
        $this->clearSelected();
    }

    public function modeEditForRows()
    {
        if(count($this->getSelected()) > 0)
        {
            $this->edit_mode = true;
            foreach($this->getSelected() as $id)
            {
                $this->id_rows_to_edit[] = $id;   
            }
        }
    }

    public function rowsToEdit($row, $value, $column)
    {
        $width = 0;
        switch($column)
        {
            case "Int_Emp_Nss":
                $width = 100;
                break;
            case "Int_Par_Id":
                $width = 80;
                break;
            case "Int_Debut":
                $width = 100;
                break;
            default:
                $width = 60;
                break;
        }

        if($this->edit_mode)
        {
            if(count($this->new_values) == count($this->id_rows_to_edit))
            {
                foreach($this->id_rows_to_edit as $id)
                {
                    if($row->id == $id)
                    {
                        $this->update();
                        return '<input style="width: ' . $width . '%;" wire:model="new_values.' . $id . '.' . $column . '" type="text"  />';
                    }
                }
            }
            else
            {
                foreach($this->id_rows_to_edit as $id)
                {
                    if($row->id == $id)
                    {
                        $this->new_values[$row->id] = $row;
                        return '<input style="width: ' . $width . '%;" wire:model="new_values.' . $id . '.' . $column . '" type="text"  />';
                    }
                }
            }
        }
        
        return $value;
    }

    public function update()
    {
        foreach($this->new_values as $id => $row)
        {
            $intervention = $this->model::find($id);
            if($row['Int_Emp_Nss'] == null)
            {
                $row['Int_Emp_Nss'] = "";
            }
            if($row['Int_Emp_Nss'] != $intervention->Int_Emp_Nss && $row['Int_Emp_Nss'] != "")
            {
                $intervention->Int_Emp_Nss = $row['Int_Emp_Nss'];
            }
            if($row['Int_Par_Id'] == null)
            {
                $row['Int_Par_Id'] = "";
            }
            if($row['Int_Par_Id'] != $intervention->Int_Par_Id && $row['Int_Par_Id'] != "")
            {
                $intervention->Int_Par_Id = $row['Int_Par_Id'] ;
            }
            if($row['Int_Debut'] == null)
            {
                $row['Int_Debut'] = "";
            }
            if($row['Int_Debut'] != $intervention->Int_Debut && $row['Int_Debut'] != "")
            {
                $intervention->Int_Debut = $row['Int_Debut'];
            }
            if($row['Int_Nb_Jours'] == null)
            {
                $row['Int_Nb_Jours'] = "";
            }
            if($row['Int_Nb_Jours'] != $intervention->Int_Nb_Jours && $row['Int_Nb_Jours'] != "")
            {
                $intervention->Int_Nb_Jours = $row['Int_Nb_Jours'];
            }
            
            $intervention->update();

        }
    }

    public function deleteAll()
    {

        foreach($this->getSelected() as $id)
        {
            DB::table('interventions')->where('id', $id)->delete();   
        }

        $this->clearSelected();
    }
}
