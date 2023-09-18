<?php

namespace App\Http\Livewire\Admin;

use App\Models\Rols;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\Wallets;
use Illuminate\Support\Facades\DB;

class Users extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $modalFormVisable = false;
    public $modalConfirmDeletVisable = false;

    public  $modelId, $role, $name,  $password, $email;
    public $search = '';
    // validation datat
    public function rules()
    {
        return [
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
            // |email', 'email', 'not_in:' . auth()->user()->email->ignore($this->modelId)
            //     Rule::unique('locations')->where(function($query){
            //         $query->where('email', $this->email);
            //     })->ignore($this->modelId)],
            // ];
        ];
    }


    public function amount()
    {
        $this->resetPage();
    }
    // create data & reset model vars
    public function create()
    {
        $this->validate();
        User::create($this->modelData());
        Wallets::create($this->walletData());
        session()->flash('message', 'تم اضافه المستخدم بنجاح ');

        $this->modalFormVisable = false;
        $this->resetVars();
    }

        // data in model
        public function modelData()
        {
            return [
                'role_id' => $this->role,
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ];
        }
        public function walletData(){

            $user=DB::table('users')->latest()->first();
            // dd($user);
            $userId=$user->id;
            return[
                'user_id' =>$userId,
                'balance'=>0,
            ];
        }



    public function createShowModal()
    {
        $this->resetVars();
        $this->modalFormVisable = true;
    }

    //model data after click update
    public function updateShowModel($id)
    {
        $this->resetValidation();
        $this->resetVars();
        $this->modelId = $id;
        $this->modalFormVisable = true;
        $this->loadModel();
        $this->resetPage();
    }

    //delet category
    public function deletShowModel($id)
    {
        $this->modelId = $id;
        $this->modalConfirmDeletVisable = true;
    }

    public function loadModel()
    {
        $user = User::find($this->modelId);
        $this->role = $user->rols->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = $user->password;
    }

    // update data
    public function update()
    {
        $this->validate();
        User::find($this->modelId)->update($this->modelData());
        session()->flash('message', 'تم تعديل المستخدم بنجاح ');

        $this->modalFormVisable = false;
    }

    // delete data
    public function delete()
    {

        User::destroy($this->modelId);
        $this->modalConfirmDeletVisable = false;
        $this->resetPage();
        session()->flash('message', 'تم حذف المستخدم بنجاح ');

    }



    public function resetVars()
    {
        $this->role = null;
        $this->name = null;
        $this->email = null;
        $this->password = null;
        $this->modelId = null;
    }

    public function render()
    {
        // $users = User::orderBy('id', 'desc')->paginate(10);
        $users = User::where('name', 'like', '%'.$this->search.'%')->orderBy('id','DESC')->paginate(10);

        $rols = Rols::all();
        return view('livewire.admin.users', [
            'users' => $users,
            'rols' => $rols,
        ]);
    }
}
