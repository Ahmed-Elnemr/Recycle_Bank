<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Media;
use App\Models\categories;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class categoryTheme extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $modalFormVisable = false;
    public $modalConfirmDeletVisable = false;

    public  $modelId, $name_en, $name_ar, $image, $media_id, $imagefile, $file_name;


    // public $name_ar, $name_en, $imagefile;
    // public $search = '';

    public function closeModal()
    {
        $this->resetVars();
        $this->resetPage();
    }
    public function rules()
    {
        return [
            'name_en' => ['required'],
            'name_ar' => ['required'],
            'imagefile' => ['required']
        ];
    }

    // public function updated($fields)
    // {
    //     $this->validateOnly($fields);
    // }
    ########################################################################

    public function createCategory()
    {
        $this->validate();
        if (empty($this->imagefile)) {
            categories::create($this->modelData());
            session()->flash('message', 'تم اضافه الفئه بنجاح');
            //         $this->dispatchBrowserEvent('close-modal');
            $this->dispatchBrowserEvent('close-modal');
            $this->resetVars();
        } else {
            Media::create($this->modelMediaData());
            $lastMedia = DB::table('media')->orderBy('id', 'desc')->first();
            // dd($lastMedia->id);
            $this->media_id = $lastMedia->id;
            // dd($this->media_id);
            categories::create($this->modelData());
            session()->flash('message', 'تم اضافه الفئه بنجاح');
            $this->dispatchBrowserEvent('close-modal');
            $this->resetVars();
            return route('category_theme');
        }
    }
    public function resetVars()
    {
        $this->name_ar = null;
        $this->name_en = null;
        $this->modelId = null;
        $this->media_id = null;
    }

    public function modelData()
    {
        return [
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'media_id' => $this->media_id,
        ];
    }
    public $pathImage;
    public function modelMediaData()
    {
        if ($this->modelId) {

            $item = categories::find($this->modelId);
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

    #############################################################################

    public function updateCategory()
    {
        // $this->validate();
        if (empty($this->imagefile)) {
        } else {
            Media::create($this->modelMediaData());
            $lastNewMedia = DB::table('media')->orderBy('id', 'desc')->first();
            $this->media_id = $lastNewMedia->id;
        }
        categories::find($this->modelId)->update($this->modelData());
        $this->dispatchBrowserEvent('close-modal');
        $this->resetVars();
        // $this->resetPage();
    }

    public function editCategory($id)
    {
        $this->resetValidation();
        $this->resetVars();
        $this->modelId = $id;
        // $this->modalFormVisable = true;
        $this->loadModel();
        $this->resetPage();
    }

    public function loadModel()
    {
        $category = categories::find($this->modelId);
        $this->name_en = $category->name_en;
        $this->name_ar = $category->name_ar;
        $this->media_id = $category->media_id;
        $idMedia = $category->media_id;
        $image = Media::find($idMedia);
        $this->imagefile = $image->path;
    }


    //     public function savecategory()
    //     {
    //         $validatedData = $this->validate();

    //         categories::create($validatedData);
    //         session()->flash('message','تم اضافه الفئه بنجاح');
    //         $this->resetInput();
    //         $this->dispatchBrowserEvent('close-modal');
    //     }
    // #############################################################################

















    // #############################################################################

    //     public function editStudent(int $student_id)
    //     {
    //         $student = Student::find($student_id);
    //         if($student){

    //             $this->student_id = $student->id;
    //             $this->name = $student->name;
    //             $this->email = $student->email;
    //             $this->course = $student->course;
    //         }else{
    //             return redirect()->to('/students');
    //         }
    //     }

    //     public function updateStudent()
    //     {
    //         $validatedData = $this->validate();

    //         Student::where('id',$this->student_id)->update([
    //             'name' => $validatedData['name'],
    //             'email' => $validatedData['email'],
    //             'course' => $validatedData['course']
    //         ]);
    //         session()->flash('message','Student Updated Successfully');
    //         $this->resetInput();
    //         $this->dispatchBrowserEvent('close-modal');
    //     }

    //     public function deleteStudent(int $student_id)
    //     {
    //         $this->student_id = $student_id;
    //     }

    //     public function destroyStudent()
    //     {
    //         Student::find($this->student_id)->delete();
    //         session()->flash('message','Student Deleted Successfully');
    //         $this->dispatchBrowserEvent('close-modal');
    //     }

    //     public function closeModal()
    //     {
    //         $this->resetInput();
    //     }

    //     public function resetInput()
    //     {
    //         $this->name_en = '';
    //         $this->name_ar = '';
    //         $this->imagefile = '';
    //     }


    public function render()
    {
        $categories = categories::orderBy('id', 'desc')->paginate(10);
        $images = Media::all();
        return view('livewire.admin.category-theme', ['categories' => $categories, 'images' => $images]);
    }
}