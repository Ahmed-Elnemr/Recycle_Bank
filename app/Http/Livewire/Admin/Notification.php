<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Notifications;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;


class Notification extends Component
{
    use WithPagination;
    public $modalFormVisable = false;
    public $modalConfirmDeletVisable = false;

    public  $modelId, $massage, $title;

    // validation datat
    public function rules()
    {
        return [
            'massage' => ['required'],
            'title' => ['required'],

        ];
    }

    public function cancel(){
         $this->modalConfirmDeletVisable = false;
         $this->resetVars();
    }


    public function amount()
    {
        $this->resetVars();
        $this->resetPage();
    }
    // create data & reset model vars
    public function create()
    {
        $this->validate();
        Notifications::create($this->modelData());
        session()->flash('message', 'تم اضافه الاشعار بنجاح ');
        Notifications::sendNotification($this->modelData());
        $this->modalFormVisable = false;
        $this->resetVars();
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

    //delet noty
    public function deletShowModel($id)
    {
        $this->modelId = $id;
        $this->modalConfirmDeletVisable = true;
    }

    public function loadModel()
    {
        $notification = Notifications::find($this->modelId);
        $this->massage = $notification->massage;
        $this->title = $notification->title;
    }

    // update data
    public function update()
    {
        $this->validate();
        Notifications::find($this->modelId)->update($this->modelData());
        session()->flash('message', 'تم تعديل الاشعار بنجاح ');

        $this->modalFormVisable = false;

    }

    // delete data
    public function delete()
    {

        Notifications::destroy($this->modelId);
        $this->modalConfirmDeletVisable = false;
        $this->resetPage();
        session()->flash('message', 'تم حذف الاشعار بنجاح ');

    }


    // data in model
    public function modelData()
    {
        return [
            'massage' => $this->massage,
            'title' => $this->title,
        ];
    }
    // reset variables
    public function resetVars()
    {
        $this->massage = null;
        $this->title = null;
        $this->modelId = null;
    }

    public function render()
    {
        $notifications = Notifications::WhereNull('user_id')->orderBy('id', 'desc')->paginate(10);
        return view('livewire.admin.notification',['notifications'=>$notifications]);
    }
}
