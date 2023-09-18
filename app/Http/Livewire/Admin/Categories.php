<?php

namespace App\Http\Livewire\Admin;

use App\Models\Media;
use Livewire\Component;
use App\Models\categories as cat;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class Categories extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $modalFormVisable = false;
    public $modalConfirmDeletVisable = false;
    public $search = '';


    public  $modelId, $name_en, $name_ar, $image, $media_id, $imagefile,$file_name;

    public function rules()
    {
        return [
            'name_en' => ['required'],
            'name_ar' => ['required'],
            'imagefile' => ['required']
        ];
    }
    // ->ignore($this->modelId)

    // data in model



    // reset data
    public function resetVars()
    {
        $this->name_ar = null;
        $this->name_en = null;
        $this->modelId = null;
        $this->media_id = null;
    }

    //amount
    public function amount()
    {
        $this->resetPage();
    }
/////////////////////////////////
public $pathImage;
    public function modelMediaData()
    {
        if ($this->modelId) {

            $item = cat::find($this->modelId);
            $idMedia = $item->media_id;
            $image = Media::find($idMedia);
            $this->pathImage = $image->path;

            if ($this->imagefile != $this->pathImage) {
                $file_extension = $this->imagefile->getClientOriginalName();
                $this->file_name = time() . '.' . $file_extension;
                $this->imagefile->storeAs('images', $this->file_name, 'media');
                $this->imagefile = "https://recyclebankegypt.com/public/images/" . $this->file_name;
                return [
                    'path' => $this->imagefile,
                ];
            } else {
                return [
                    'path' => $this->pathImage,
                ];
            }
        }
        $file_extension = $this->imagefile->getClientOriginalName();
        $this->file_name = time() . '.' . $file_extension;
        $this->imagefile->storeAs('images', $this->file_name, 'media');
        $this->imagefile = "https://recyclebankegypt.com/public/images/" . $this->file_name;
        return [
            'path' => $this->imagefile,
        ];
    }

    //////
    public function modelData()
    {
        return [
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'media_id' => $this->media_id,
        ];
    }
    ////////////////////////
    public function update()
    {
        // $this->validate();
        if (empty($this->imagefile)) {
        } else {
            Media::create($this->modelMediaData());
            $lastNewMedia = DB::table('media')->orderBy('id', 'desc')->first();
            $this->media_id = $lastNewMedia->id;
            session()->flash('message', 'تم تعديل التصنيف بنجاح ');
        }
        cat::find($this->modelId)->update($this->modelData());
        session()->flash('message', 'تم تعديل التصنيف بنجاح ');
        $this->modalFormVisable = false;
        $this->resetVars();
       // $this->resetPage();
    }


    // create data & reset model vars
    public function create()
    {
        $this->validate();
        if (empty($this->imagefile)) {
            cat::create($this->modelData());
            session()->flash('message', 'تم اضافه التصنيف بنجاح ');

            $this->modalFormVisable = false;
            $this->resetVars();
        } else {
            Media::create($this->modelMediaData());
            $lastMedia = DB::table('media')->orderBy('id', 'desc')->first();
            // dd($lastMedia->id);
            $this->media_id = $lastMedia->id;
            // dd($this->media_id);
            cat::create($this->modelData());
            session()->flash('message', 'تم اضافه التصنيف بنجاح ');

            $this->modalFormVisable = false;
            $this->resetVars();
        }

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
        $category = cat::find($this->modelId);
        $this->name_en = $category->name_en;
        $this->name_ar = $category->name_ar;
        $this->media_id = $category->media_id;
        $idMedia = $category->media_id;
        $image = Media::find($idMedia);
        $this->imagefile = $image->path;
    }



    // delete data
    public function delete()
    {
        $category = cat::find($this->modelId);
        $idMedia = $category->media_id;
        Media::destroy($idMedia);

        /////////
        cat::destroy($this->modelId);
        $this->modalConfirmDeletVisable = false;
        $this->resetPage();
        session()->flash('message', 'تم حذف التصنيف بنجاح ');

    }

    ////////////////////////////////////////////////////////////////
    public function cancel()
    {
        $this->modalConfirmDeletVisable = false;
    }


    public function render()
    {
        $categories = cat::where('name_ar', 'like', '%'.$this->search.'%')->orderBy('id', 'desc')->paginate(10);
        $images = Media::all();
        return view('livewire.admin.categories', ['categories' => $categories, 'images' => $images]);
    }

}