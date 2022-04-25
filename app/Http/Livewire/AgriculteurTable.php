<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Agriculteur;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class AgriculteurTable extends DataTableComponent
{
    protected $model = Agriculteur::class;

    public $edit_mode = false;
    public $id_rows_to_edit = [];
    public $new_values = [];

    public function configure(): void
    {
        $this->setPrimaryKey('Agr_Id');
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
            Column::make("Id", "Agr_Id")
                ->sortable(),
            Column::make("Nom", "Agr_Nom")
                ->searchable()
                ->format(
                    fn($value, $row, Column $column) => $this->rowsToEdit($row, $value, "Agr_Nom")
                ) ->html()
                ->sortable(),
            Column::make("Prenom", "Agr_prn")
                ->searchable()
                ->format(
                    fn($value, $row, Column $column) => $this->rowsToEdit($row, $value, "Agr_prn")
                ) ->html()
                ->sortable(),
            Column::make("Residence", "Agr_Resid")
                ->searchable()
                ->format(
                    fn($value, $row, Column $column) => $this->rowsToEdit($row, $value, "Agr_Resid")
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
            case "Agr_Nom":
                $width = 120;
                break;
            case "Agr_prn":
                $width = 120;
                break;
            case "Agr_Resid":
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
                    if($row->Agr_Id == $id)
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
                    if($row->Agr_Id == $id)
                    {
                        $this->new_values[$row->Agr_Id] = $row;
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
            $agriculteur = $this->model::find($id);
            if($row['Agr_Nom'] == null)
            {
                $row['Agr_Nom'] = "";
            }
            if($row['Agr_Nom'] != $agriculteur->Agr_Nom && $row['Agr_Nom'] != "")
            {
                $agriculteur->Agr_Nom = $row['Agr_Nom'];
            }
            if($row['Agr_prn'] == null)
            {
                $row['Agr_prn'] = "";
            }
            if($row['Agr_prn'] != $agriculteur->Agr_prn && $row['Agr_prn'] != "")
            {
                $agriculteur->Agr_prn = $row['Agr_prn'] ;
            }
            if($row['Agr_Resid'] == null)
            {
                $row['Agr_Resid'] = "";
            }
            if($row['Agr_Resid'] != $agriculteur->Agr_Resid && $row['Agr_Resid'] != "")
            {
                $agriculteur->Agr_Resid = $row['Agr_Resid'];
            }
            
            $agriculteur->update();

        }
    }

    public function deleteAll()
    {

        foreach($this->getSelected() as $id)
        {
            DB::table('agriculteurs')->where('Agr_Id', $id)->delete();   
        }

        $this->clearSelected();
    }

}
