<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Media as ImagesModel;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;


class Media extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $modalFormVisable = false;
    public $modalConfirmDeletVisable = false;

    public  $modelId, $imagefile;


    public function amount()
    {
        $this->resetPage();
    }






    // public $path_x;
    public function create()
    {
        $this->validate();
        ImagesModel::create($this->modelData());
        $this->modalFormVisable = false;
        $this->resetVars();

        ############3

        // $ImagesModel = new ImagesModel();
        // $file_extension = $this->imagefile->getClientOriginalExtension();
        // $file_name = time() . '.' . $file_extension;
        // $this->imagefile->storeAs('images', $file_name, 'media');
        // $this->imagefile = "images/" . $file_name;
        // $ImagesModel->path =  $this->imagefile;
        // // url('/') . "/public/images/" . $file_name;
        // $ImagesModel->save();

        // $this->modalFormVisable = false;
        // $this->resetVars();
        // $this->resetPage();
    }

    // data in model
    public function modelData()
    {

        if ($this->modelId) {

            return [
                'path' => $this->imagefile,
            ];
        } else {
            $file_extension = $this->imagefile->getClientOriginalName();
            $file_name = time() . '.' . $file_extension;
            $this->imagefile->storeAs('images', $file_name, 'media');
            $this->imagefile = "images/" . $file_name;
            return [
                'path' => $this->imagefile,
            ];
        }
    }

    //model data after click update
    public function updateShowModel($id)
    {
        // $this->resetValidation();
        // $this->resetVars();
        $this->modelId = $id;
        $this->modalFormVisable = true;
        $this->loadModel();
        // $this->resetPage();
    }
    public function loadModel()
    {

        $image = ImagesModel::find($this->modelId);

        $this->imagefile = $image->path;
    }
    //delet category
    public function deletShowModel($id)
    {
        $this->modelId = $id;
        $this->modalConfirmDeletVisable = true;
    }
    ////////////////////////////////////////////////////////////////
    public function cancel()
    {
        $this->modalConfirmDeletVisable = false;
    }

    public function rules()
    {
        return [
            'imagefile' => ['required'],

        ];
    }
    // update data
    public function update()
    {
        $file_name = time() . '.' . $this->imagefile->getClientOriginalName();
        $this->imagefile->storeAs('images', $file_name, 'media');
        $this->imagefile = "images/" . $file_name;
        ImagesModel::find($this->modelId)->update($this->modelData());
        $this->modalFormVisable = false;
    }


    // delete data
    public function delete()
    {
        ImagesModel::destroy($this->modelId);
        $this->modalConfirmDeletVisable = false;
        $this->resetPage();
    }



    // reset data
    public function resetVars()
    {
        $this->imagefile = null;
        $this->modelId = null;
    }

    public function createShowModal()
    {
        $this->resetVars();
        $this->modalFormVisable = true;
    }


    public function render()
    {
        $images = ImagesModel::orderBy('id', 'desc')->paginate(10);
        return view('livewire.admin.media', ['images' => $images]);
    }
}