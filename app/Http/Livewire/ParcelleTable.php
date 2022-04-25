<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Parcelle;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;



class ParcelleTable extends DataTableComponent
{
    protected $model = Parcelle::class;
    public $edit_mode = false;
    public $id_rows_to_edit = [];
    public $new_values = [];

    public function configure(): void
    {
        $this->setPrimaryKey('Par_Idf');

        
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
                    'closeEditMode' => 'close edit mode',
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
            
                Column::make("Id", "Par_Idf")
                    ->sortable(),
                Column::make("Par Nom", "Par_Nom")
                    ->searchable()
                    ->format(
                        fn($value, $row, Column $column) => $this->rowsToEdit($row, $value, "Par_Nom")
                    ) ->html(),
                Column::make("Par Lieu", "Par_Lieu")
                    ->format(
                        fn($value, $row, Column $column) => $this->rowsToEdit($row, $value, "Par_Lieu")
                    ) ->html()
                    ->sortable(),
                Column::make("Par Prop", "Par_Prop")
                    ->format(
                        fn($value, $row, Column $column) => $this->rowsToEdit($row, $value, "Par_Prop")
                    ) ->html()
                    ->sortable(),
                    Column::make("Par Superficie", "Par_Superficie")
                    ->format(
                        fn($value, $row, Column $column) => $this->rowsToEdit($row, $value, "Par_Superficie")
                    ) ->html()
                    ->sortable(),
                Column::make("Created at", "created_at")
                    ->sortable(),
                Column::make("Updated at", "updated_at")
                    ->sortable(),
                
            ]; 
    
       
    }

    public function closeEditMode()
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
            case "Par_Nom":
                $width = 120;
                break;
            case "Par_Lieu":
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
                    if($row->Par_Idf == $id)
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
                    if($row->Par_Idf == $id)
                    {
                        if(!isset($this->new_values[$row->Par_Idf])) 
                        {
                            $this->new_values[$row->Par_Idf] = $row;
                        }
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
            $parcelle = $this->model::find($id);
            if($row['Par_Nom'] == null)
            {
                $row['Par_Nom'] = "";
            }
            if($row['Par_Nom'] != $parcelle->Par_Nom && $row['Par_Nom'] != "")
            {
                $parcelle->Par_Nom = $row['Par_Nom'];
            }
            if($row['Par_Lieu'] == null)
            {
                $row['Par_Lieu'] = "";
            }
            if($row['Par_Lieu'] != $parcelle->Par_Lieu && $row['Par_Lieu'] != "")
            {
                $parcelle->Par_Lieu = $row['Par_Lieu'] ;
            }
            if($row['Par_Prop'] == null)
            {
                $row['Par_Prop'] = "";
            }
            if($row['Par_Prop'] != $parcelle->Par_Prop && $row['Par_Prop'] != "")
            {
                $parcelle->Par_Prop = $row['Par_Prop'];
            }
            if($row['Par_Superficie'] == null)
            {
                $row['Par_Superficie'] = "";
            }
            if($row['Par_Superficie'] != $parcelle->Par_Superficie && $row['Par_Superficie'] != "")
            {
                $parcelle->Par_Superficie = $row['Par_Superficie'];
            }
            
            $parcelle->update();


        }
    }

    public function deleteAll()
    {

        foreach($this->getSelected() as $id)
        {
            DB::table('parcelles')->where('Par_Idf', $id)->delete();   
        }

        $this->clearSelected();
    }
}
