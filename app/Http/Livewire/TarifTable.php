<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Tarif;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class TarifTable extends DataTableComponent
{
    protected $model = Tarif::class;

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

            Column::make("ID", "id")
                ->sortable(),
            Column::make("Description", "Tar_Description")
                ->searchable()
                
                ->sortable(),
            Column::make("Euro", "Tar_Euro")
                ->format(
                    fn($value, $row, Column $column) => $this->rowsToEdit($row, $value, "Tar_Euro")
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
            case "Tar_Description":
                $width = 120;
                break;
            case "Tar_Euro":
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
                    if($row->Tar_Description == $id)
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
                    if($row->Tar_Description == $id)
                    {
                        $this->new_values[$row->Tar_Description] = $row;
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
            $tarif = $this->model::find($id);
            if($row['Tar_Description'] == null)
            {
                $row['Tar_Description'] = "";
            }
            if($row['Tar_Description'] != $tarif->Tar_Description && $row['Tar_Description'] != "")
            {
                $tarif->Tar_Description = $row['Tar_Description'];
            }
            if($row['Tar_Euro'] == null)
            {
                $row['Tar_Euro'] = "";
            }
            if($row['Tar_Euro'] != $tarif->Tar_Euro && $row['Tar_Euro'] != "")
            {
                $tarif->Tar_Euro = $row['Tar_Euro'] ;
            }
           
            $tarif->update();

        }
    }

    public function deleteAll()
    {

        foreach($this->getSelected() as $id)
        {
            DB::table('tarifs')->where('Tar_Description', $id)->delete();   
        }

        $this->clearSelected();
    }
}
