<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <a class="modal-effect btn btn-outline-primary continar:block " data-toggle="modal"
                    data-target="#categoryModal" href="#"> <i class="fas fa-plus"></i> أضافه فئه</a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('Add'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('Add') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session()->has('delete'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('delete') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session()->has('edit'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('edit') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50' ;>
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">الصوره </th>
                                <th class="border-bottom-0">الأسم العربي </th>
                                <th class="border-bottom-0">Name English </th>
                                <th class="border-bottom-0">تم الانشاء في </th>
                                <th class="border-bottom-0">العمليات</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }} </td>
                                    <td>
                                        <img @if (empty($category->media->path)) src=""
                        @else
                        src="{{ $category->media->path }}" @endif
                                            style="width: 100px;height:100px;" alt="no image">
                                    </td>
                                    <td>
                                        {{ $category->name_en }}
                                    </td>
                                    <td>
                                        {{ $category->name_ar }}
                                    </td>
                                    <td>
                                        {{ $category->created_at }}
                                    </td>
                                    <td>
                                        <button data-bs-target="#updateCategoryModal" class="btn btn-outline-success btn-sm" wire:click="editCategory({{ $category->id}})">تعديل</button>

                                        <button data-bs-target="#deleteCategoryModal" class="btn btn-outline-danger btn-sm " data-toggle="modal"
                                            data-target="modaldemo8" wire:click="editStudent()">حذف</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- ############################################################## --}}
    <div wire:ignore.self class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="categoryModalLabel">انشاء فئه جديده</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModal"></button>
                </div>
                <form wire:submit.prevent="createCategory">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>الاسم العربي </label>
                            <input type="text" wire:model="name_ar" class="form-control">
                            @error('name_ar')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Name English </label>
                            <input type="text" wire:model="name_en" class="form-control">
                            @error('name_en')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>اختر صوره</label>
                            <input type="file" wire:model="imagefile" class="form-control">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer float-right">

                        <button type="submit" class="btn btn-primary">حفظ</button>
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">الغاء</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Update Student Modal -->
    <div wire:ignore.self class="modal fade" id="updateCategoryModal" tabindex="-1"
        aria-labelledby="updateCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateCategoryModalLabel">Edit Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                        aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="updateCategory">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>الاسم العربي </label>
                            <input type="text" wire:model="name_ar" class="form-control">
                            @error('name_ar')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Name English </label>
                            <input type="text" wire:model="name_en" class="form-control">
                            @error('name_en')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>اختر صوره</label>
                            <input type="file" wire:model="imagefile" class="form-control">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Student Modal -->
    <div wire:ignore.self class="modal fade" id="deleteCategoryModal" tabindex="-1"
        aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCategoryModalLabel">Delete Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                        aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destroyStudent">
                    <div class="modal-body">
                        <h4>Are you sure you want to delete this data ?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Yes! Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Model form --}}
    {{-- <div   class="modal effect-fall show" id="modaldemo8" aria-modal="true" style="padding-right: 3px; "  id="modaldemo8" wire:model="modalFormVisable" >
        
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Modal Header</h6>
                    <button aria-label="Close" class="close"
                           type="button"><span aria-hidden="true">×</span></button>

                </div>
                <div class="modal-body">
                    
                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم القسم</label>
                            <input type="text" class="form-control" id="section_name" name="section_name">

                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">ملاحظات</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">تاكيد</button>
                            <button type="button" class="btn btn-secondary">اغلاق</button>
                        </div>
                </div>

            </div>
        </div>
    </div> --}}
    {{-- ################################################### --}}
    <!-- Modal -->
    {{-- <div wire:ignore.self class="modal fade" id="addStudentModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form wire:submit.prevent="storeStudentData">
                    <div class="form-group row">
                        <label for="student_id" class="col-3">Student ID</label>
                        <div class="col-9">
                            <input type="number" id="student_id" class="form-control" wire:model="student_id">
                            @error('student_id')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-3">Name</label>
                        <div class="col-9">
                            <input type="text" id="name" class="form-control" wire:model="name">
                            @error('name')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-3">Email</label>
                        <div class="col-9">
                            <input type="email" id="email" class="form-control" wire:model="email">
                            @error('email')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-3">Phone</label>
                        <div class="col-9">
                            <input type="number" id="phone" class="form-control" wire:model="phone">
                            @error('phone')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-3"></label>
                        <div class="col-9">
                            <button type="submit" class="btn btn-sm btn-primary">Add Student</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}
