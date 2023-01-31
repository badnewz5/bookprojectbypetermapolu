<?php

namespace App\Http\Livewire\Admin\Category;


use Livewire\Component;
use App\Models\Categories;
use Illuminate\Support\Facades\File;
use Livewire\WithPagination;

class Index extends Component
{ 
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $category_id;

    public function deleteCategory($category_id)
    {   
        
        $this->category_id = $category_id;

    }

    public function destoryCategory()
    {
        $category = Categories::find($this->category_id);
        $path = 'uploads/category/'.$category->image;
        if(File::exists($path))
        {
            File::delete($path);
        }
        $category->delete();
        session()->flash('message','Category Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {   
        $categories = Categories::orderBy('id', 'DESC')->paginate(1);
        return view('livewire.admin.category.index',['categories' => $categories]);
    }
}



