<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class SearchLivewire extends Component
{




    public $searchTerm ='';
    public $users;
    // public function render()
    // {
    //     if (empty($this->searchTerm)) {
    //         $this->users = User::where('name', $this->searchTerm)->get();
    //     } else {
    //         $this->users =User::where('name', 'like', '%'.$this->searchTerm.'%')->get();
    //     }
    //     return view('livewire.users');
    // }


    
    public function render()
    {
        if (empty($this->searchTerm)) {
            $this->users = User::where('name', $this->searchTerm)->get();
        } else {
            
            $this->users =User::where('name', 'like', '%'.$this->searchTerm.'%',)->get();
        }
        return view('livewire.admin.search-livewire');
    }
}