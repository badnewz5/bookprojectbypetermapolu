<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categories;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }
    public function create()
    {
        return view('admin.category.create');

    }
    public function store(CategoryRequest  $request)
    { 
        $validatedData = $request->validated();

        $category = New Categories;
        $category->name = $validatedData['name'];
        $category->description = $validatedData['description'];
        $category->slug = Str::slug ($validatedData['slug']);

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();

            $filename = time().'.'.$ext;

            $file->move('uploads/category/', $filename);
            $category->image= $filename;
        }

        $category->status= $request->status == true ? '1':'0';
        $category->save();

        return redirect('admin/category')->with('message', 'Category Created Successfully');
    }

    public function edit(Categories $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryRequest  $request, $category)
    {   
        $validatedData = $request->validated();
        
        $category= Categories::findOrFail($category);

       
        $category->name = $validatedData['name'];
        $category->description = $validatedData['description'];
        $category->slug = Str::slug ($validatedData['slug']);

        if($request->hasFile('image'))
        { 
            $path = 'uploads/category/'.$category->image;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();

            $filename = time().'.'.$ext;

            $file->move('uploads/category/', $filename);
            $category->image= $filename;
        }

        $category->status= $request->status == true ? '1':'0';
        $category->update();

        return redirect('admin/category')->with('message', 'Category Update Successfully');
    }
}
