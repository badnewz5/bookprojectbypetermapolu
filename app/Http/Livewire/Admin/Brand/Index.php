<?php

namespace App\Http\Livewire\Admin\Brand;
use App\Models\Brands;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{   
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $name = '';
    public $slug ='';
    public $status = '';
    public $brand_id;

    protected $rules = [
        'name' => 'required|string',
        'slug' => 'required|string',
    ];

    public function resertInput()
    {
        $this->name = NULL;
        $this->status = NULL;
        $this->slug = NULL;
    }
    public function storeBrand()
    { 
        $this->validate();
        Brands::create([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? '1':'0',
        ]);
        session()->flash('message','Brand Created Suffully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resertInput();

    }


    public function closeModal()
    {
        $this->resertInput();
    }

    public function openModal()
    {
        $this->resertInput();
    }


    public function editBrand(int $brand_id)
    {   
        $this->brand_id = $brand_id;
        $brands = Brands::findOrFail($brand_id);
        $this->name = $brands->name;
        $this->slug = $brands->slug;

    }

    public function updateBrand()
    { 
        $this->validate();
        Brands::findOrFail($this->brand_id)->update([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? '1':'0',
        ]);
        session()->flash('message','Brand Update Suffully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resertInput();

    }

    public function deletebrand(int $brand_id)
    {   

        $this->brand_id = $brand_id;
       
    }

    public function destoryBrand()
    { 

        $brands = Brands::findOrFail($this->brand_id)->delete();
        session()->flash('message','Brand Delete Suffully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resertInput();

    }
    public function render()
    {   
        $brands = Brands::orderBy('id', 'DESC')->paginate(3);
        return view('livewire.admin.brand.index',['brands' => $brands])
        ->extends('layouts.admin')
        ->section('content');
    }
}
