<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\AppSettings;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;


class AppSetting extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $modalFormVisable = false;
    public $modalConfirmDeletVisable = false;

    public  $modelId, $key, $value;

    // validation datat
    public function rules()
    {
        return [
            'key' => ['required'],
            'value' => ['required'],

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
        AppSettings::create($this->modelData());
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

    //delet category
    public function deletShowModel($id)
    {
        $this->modelId = $id;
        $this->modalConfirmDeletVisable = true;
    }

    public function loadModel()
    {
        $settting = AppSettings::find($this->modelId);
        $this->key = $settting->key;
        $this->value = $settting->value;
    }

    // update data 
    public function update()
    {
        $this->validate();
        AppSettings::find($this->modelId)->update($this->modelData());
        $this->modalFormVisable = false;
    }

    // delete data
    public function delete()
    {

        AppSettings::destroy($this->modelId);
        $this->modalConfirmDeletVisable = false;
        $this->resetPage();
    }


    // data in model 
    public function modelData()
    {
        return [
            'key' => $this->key,
            'value' => $this->value,
        ];
    }
    // reset data
    public function resetVars()
    {
        $this->key = null;
        $this->value = null;
        $this->modelId = null;
    }

    public function render()
    {
        $settings = AppSettings::orderBy('id', 'desc')->paginate(10);
        return view('livewire.admin.app-setting', ['settings' => $settings]);
    }
}