<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public $new_role = [] ;

    public $available_roles = ["admin", "editor", "viewer"];

    public function configure(): void
    {
        $this->setPrimaryKey('id');


        $this->setTrAttributes(function($row, $index) {
            $current_user = Auth::user();
            if ($row->email == $current_user->email) {
              return [
                'style' => 'background-color: rgb(217 249 157);',
              ];
            }
      
            return [];
        });
    }

    public function bulkActions(): array
    {
        if(Gate::allows('isAdmin'))
        {

            return [
                'deleteAll' => 'delete',
            ];
        }
        else
        {
            return [];
        }

    }


    public function columns(): array
    {

        
        $user_roles = DB::table('user_roles') ->select('user_email', 'role')
            ->get();
        $users = DB::table('users')
            ->select('id', 'email')
            ->get();

        foreach($user_roles as $user_role)
        {
            foreach($users as $user)
            {
                if($user->email == $user_role->user_email)
                {
                    $this->new_role[$user->id] = $user_role->role ;
                }
            }
        }

        if(Gate::allows('isAdmin'))
        {

            return [
                Column::make("Id", "id")
                    ->sortable(),
                Column::make("Name", "name")
                    ->searchable()
                    ->sortable(),
                Column::make("Email", "email")
                    ->searchable()
                    ->sortable(),
                Column::make("Created at", "created_at")
                    ->sortable(),
                Column::make("Updated at", "updated_at")
                    ->sortable(),
                Column::make('Roles')
                    ->label(
                        fn($row, Column $column) => 
                        
                        '
                        <form  wire:click.prevent="setRole(\''. $row->email .'\', ' . $row->id . ')" action="" method="" >
                            <select style="width: 90%;"  wire:model="new_role.' . $row->id . '" class="custom-select" >
                                <option value="viewer" >viewer</option>
                                <option value="editor" >editor</option>
                                <option value="admin" >admin</option>
                            </select>
    
                        </form>
                        '
    
                    )->html()
                    ,
            ];
            
        }
        else
        {
            return [
                Column::make("Id", "id")
                    ->sortable(),
                Column::make("Name", "name")
                    ->searchable()
                    ->sortable(),
                Column::make("Email", "email")
                    ->searchable()
                    ->sortable(),
                Column::make("Created at", "created_at")
                    ->sortable(),
                Column::make("Updated at", "updated_at")
                    ->sortable(),
                
            ];
        }

        

        
    }

    function setRole($email, $id)
    {

        $current_user = Auth::user();
           // verifier si user est un admin           verifier si le mêm rôle                               // verifier si le rôle est correcte                  // ne permet pas à l'utilisateur courant de modifier son rôle
        if(Gate::allows('isAdmin') && ($this->new_role[$id] != $this->getRole($email)) && in_array($this->new_role[$id], ["admin", "editor", "viewer"]) && $email != $current_user->email )
        {
            DB::table('user_roles')
                ->where('user_email', $email)
                ->update(['role' => $this->new_role[$id]]);  
        }
    }

    function getRole($email)
    {
        $role = DB::table('user_roles')->where('user_email', $email)->value('role');
        return $role;
    }

    public function deleteAll()
    {
        $current_user = Auth::user();

        foreach($this->getSelected() as $id)
        {
            if($current_user->id != $id)
            {
                DB::table('users')->where('id', $id)->delete();   
            }
        }

        $this->clearSelected();
    }

}
