<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Employe;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class EmployeTable extends DataTableComponent
{
    protected $model = Employe::class;

    public $edit_mode = false;
    public $id_rows_to_edit = [];
    public $new_values = [];


    public function configure(): void
    {
        $this->setPrimaryKey('Emp_Nss');
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
            Column::make("NSS", "Emp_Nss")
                ->searchable()
                ->sortable(),
            Column::make("Nom", "Emp_Nom")
                ->searchable()
                ->format(
                    fn($value, $row, Column $column) => $this->rowsToEdit($row, $value, "Emp_Nom")
                ) ->html()
                ->sortable(),
            Column::make("Prenom", "Emp_Prenom")
                ->searchable()
                ->format(
                    fn($value, $row, Column $column) => $this->rowsToEdit($row, $value, "Emp_Prenom")
                ) ->html()
                ->sortable(),
            Column::make("Tarif", "Emp_Tarif")
                ->format(
                    fn($value, $row, Column $column) => $this->rowsToEdit($row, $value, "Emp_Tarif")
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
            case "Emp_Nom":
                $width = 120;
                break;
            case "Emp_Prenom":
                $width = 120;
                break;
            case "Emp_Tarif":
                $width = 120;
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
                    if($row->Emp_Nss == $id)
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
                    if($row->Emp_Nss == $id)
                    {
                        $this->new_values[$row->Emp_Nss] = $row;
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
            $employe = $this->model::find($id);
            if($row['Emp_Nom'] == null)
            {
                $row['Emp_Nom'] = "";
            }
            if($row['Emp_Nom'] != $employe->Emp_Nom && $row['Emp_Nom'] != "")
            {
                $employe->Emp_Nom = $row['Emp_Nom'];
            }
            if($row['Emp_Prenom'] == null)
            {
                $row['Emp_Prenom'] = "";
            }
            if($row['Emp_Prenom'] != $employe->Emp_Prenom && $row['Emp_Prenom'] != "")
            {
                $employe->Emp_Prenom = $row['Emp_Prenom'] ;
            }
            if($row['Emp_Tarif'] == null)
            {
                $row['Emp_Tarif'] = "";
            }
            if($row['Emp_Tarif'] != $employe->Emp_Tarif && $row['Emp_Tarif'] != "")
            {
                $employe->Emp_Tarif = $row['Emp_Tarif'];
            }
            
            $employe->update();

        }
    }

    public function deleteAll()
    {

        foreach($this->getSelected() as $id)
        {
            DB::table('employes')->where('Emp_Nss', $id)->delete();   
        }

        $this->clearSelected();
    }

}
