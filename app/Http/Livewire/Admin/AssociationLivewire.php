<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AssociationModel;
use Illuminate\Support\Facades\DB;


class AssociationLivewire extends Component
{
    use WithPagination;
    public $search='';


    public function filter()
    {

        if($this->search != null){

            return AssociationModel::search($this->search);
        }else{
            return AssociationModel::search("%");
        }

    }





    public function approve($id){

        AssociationModel::approve($id);

    }

    public function makepayment($id)
    {
        AssociationModel::makepayment($id);
    }

    public function render()
    {
    // $associations=AssociationModel::orderBy('id','desc')->paginate(10);


        return view('livewire.admin.association-livewire',[
            'associations'=>$this->filter(),
        ]);
    }
}
