<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class UsersTable extends DataTableComponent
{
    protected $model = User::class;

    public $new_role = [] ;
    public $new_id = [] ;


    public function configure(): void
    {

        
          $this->setTrAttributes(function($row, $index) {
            $current_user = Auth::user();
            if ($row->email == $current_user->email) {
              return [
                'style' => 'background-color: rgb(217 249 157);',
              ];
            }
      
            return [];
        });

        $this->setSingleSortingDisabled();

        $this->setPageName('users');

        $this->setPrimaryKey('id');

    }

    public function bulkActions(): array
    {
        if(Gate::allows('isAdmin'))
        {

            return [
                'deleteAll' => 'delete',
            ];
        }

    }

    public function columns(): array
    {
        
        return [
            Column::make("Id", "id")
                //->sortable()
                ,
            Column::make("Name", "name")
                ->searchable()
                //->sortable()
                ,
            Column::make("Email", "email")
                ->searchable()
                //->sortable()
                ,
            Column::make("Created at", "created_at")
                //->sortable()
                ,
            Column::make("Updated at", "updated_at")
                //->sortable()
                ,
            Column::make('Roles')
                ->label(
                    fn($row, Column $column) => $this->getSelectRoles($row)
                )->html()
                ,
           
        ];
    }

    function getSelectRoles($row)
    {
        $available_roles = ["admin", "editor", "viewer"];
        $this->new_role[$row->id] = $this->getRole($row->id) ;
        $out_put = "";

        $out_put .= '<form id="' . $row->id . '" wire:click.prevent="setRole(\'' .  $row->id . '\')" class="" method="" action=""> ' ;
        $out_put .= '<select style="width: 90%;" wire:model="new_role.' . $row->id . '" class="custom-select" >' ;
        $out_put .= '<option disabled >select a role</option>' ;

        foreach($available_roles as $role)
        {
            $out_put .= '<option value="' . $role . '" >' . $role . '</option>' ;
        }           
        $out_put .= '</select>' ;
        $out_put .= '</form>' ;
       
        return $out_put;
    }
 
    function setRole($id)
    {
        $current_user = Auth::user();
        $user = DB::table('users')->find($id);
           // verifier si user est un admin           verifier si le mêm rôle                               // verifier si le rôle est correcte                  // ne permet pas à l'utilisateur courant de modifier son rôle
        if(Gate::allows('isAdmin') && ($this->new_role[$id] != $this->getRole($id)) && in_array($this->new_role[$id], ["admin", "editor", "viewer"]) && $user->email != $current_user->email )
        {
            DB::table('user_roles')
                ->where('user_email', $user->email)
                ->update(['role' => $this->new_role[$id]]);
        }
    }

    function getRole($id)
    {
        $user = DB::table('users')->find($id);
        $role = DB::table('user_roles')->where('user_email', $user->email)->value('role');
        return $role;
    }

    public function deleteAll()
    {
        $current_user = Auth::user();

        foreach($this->getSelected() as $id)
        {
            if($current_user->id != $id)
            {
                if(($this->getRole($id) != "admin") || (DB::table('user_roles')->where('role', "admin")->count() > 1))
                {
                    DB::table('users')->where('id', $id)->delete();   
                }
            }
        }

        $this->clearSelected();
    }

   
}
