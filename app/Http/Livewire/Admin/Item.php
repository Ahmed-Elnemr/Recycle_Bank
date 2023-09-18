<?php

namespace App\Http\Livewire\Admin;

use App\Models\Items;

use App\Models\Media;
use Livewire\Component;
use App\Models\categories;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;


class Item extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $modalFormVisable = false;
    public $modalConfirmDeletVisable = false;
    public $search = '';

    public  $modelId, $name_en, $name_ar, $value, $category_id, $media_id, $imagefile, $file_name,$piece,$weight;

    // validation datat
    public function rules()
    {
        return [
            'name_en' => ['required'],
            'name_ar' => ['required'],
            'value' => ['required'],
            'piece' => ['required'],
            'weight' => ['required'],
            'category_id' => ['required'],
            'imagefile' => ['required'],
        ];
    }


    public function amount()
    {
        $this->resetPage();
    }

    ###################################   Start  Create     ####################
    public function createShowModal()
    {
        $this->resetVars();
        $this->modalFormVisable = true;
    }
    #############

    public function create()
    {
        $this->validate();
        if (empty($this->imagefile)) {

            Items::create($this->modelDataIteme());
            session()->flash('message', 'تم اضافه العنصر بنجاح ');

            $this->modalFormVisable = false;
            $this->resetVars();
        } else {
            Media::create($this->modelMediaData());
            $lastNewMedia = DB::table('media')->orderBy('id', 'desc')->first();
            $this->media_id = $lastNewMedia->id;
            Items::create($this->modelDataIteme());
            session()->flash('message', 'تم اضافه العنصر بنجاح ');

            $this->modalFormVisable = false;
            $this->resetVars();
        }
    }
    #######  model  data media
    public $pathImage;
    public function modelMediaData()
    {
        if ($this->modelId) {

            $item = items::find($this->modelId);
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
    ###### model  data item
    public function modelDataIteme()
    {
        return [
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'value' => $this->value,
            'piece' => $this->piece,
            'weight' => $this->weight,
            'category_id' => $this->category_id,
            'media_id' => $this->media_id,
        ];
    }
    ###################################   End  Create     ####################
    ###################################   Start  Update     ####################
    ##### show model after click update button
    public function updateShowModel($id)
    {
        // $this->resetValidation();
        $this->resetVars();
        $this->modelId = $id;
        $this->modalFormVisable = true;
        $this->loadModel();
    }
    ##### Load Model data
    public function loadModel()
    {
        $item = items::find($this->modelId);
        $this->name_en = $item->name_en;
        $this->name_ar = $item->name_ar;
        $this->value = $item->value;
        $this->piece = $item->piece;
        $this->weight = $item->weight;
        $this->category_id = $item->category_id;
        $this->media_id = $item->media_id;
        $idMedia = $item->media_id;
        $image = Media::find($idMedia);
        $this->imagefile = $image->path;
    }

    ####### Update Data base after click update model
    public function update()
    {
        // $this->validate();
        if (empty($this->imagefile)) {
        } else {
            Media::create($this->modelMediaData());
            session()->flash('message', 'تم نعديل العنصر بنجاح ');

            $lastNewMedia = DB::table('media')->orderBy('id', 'desc')->first();
            $this->media_id = $lastNewMedia->id;
        }
        Items::find($this->modelId)->update($this->modelDataIteme());
        session()->flash('message', 'تم تعديل العنصر بنجاح ');

        $this->modalFormVisable = false;
        $this->resetVars();
      //  $this->resetPage();
    }
    ###################################   End  Update     ####################
    ###################################   Start  Delete     ####################

    public function deletShowModel($id)
    {
        $this->modelId = $id;
        // $item = items::find($this->modelId);
        // $idMedia = $item->media_id;
        // $image = Media::find($idMedia);
        // $this->pathImage = $image->path;

        $this->modalConfirmDeletVisable = true;
    }
    // delete data
    public function delete()
    {

        $item = items::find($this->modelId);
        $idMedia = $item->media_id;
        //  unlink($this->pathImage);
        // Media::destroy($idMedia);
        items::destroy($this->modelId);
        $this->modalConfirmDeletVisable = false;
        $this->resetVars();
        $this->resetPage();
        session()->flash('message', 'تم حذف العنصر بنجاح ');

    }
    ###################################   End  Delete     ####################

    #####reset data
    public function resetVars()
    {
        $this->name_ar = null;
        $this->name_en = null;
        $this->value = null;
        $this->piece = null;
        $this->weight = null;
        $this->category_id = null;
        $this->media_id = null;
        $this->modelId = null;
        $this->file_name = null;
    }
    ### cancel delete model
    public function cancel()
    {
        $this->modalConfirmDeletVisable = false;
    }
        ######render view
    public function render()
    {
        $items = items::where('name_ar', 'like', '%'.$this->search.'%')->orderBy('id', 'asc')->paginate(10);
        $categories = categories::all();
        $images = Media::all();
        return view('livewire.admin.item', ['items' => $items, 'categories' => $categories, 'images' => $images]);
    }
}
