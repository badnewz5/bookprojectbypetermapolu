<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Str;
use App\Models\Categories;
use App\Models\Brands;
use App\Models\Product_Images;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductFormRequest;

class ProductController extends Controller
{
    public function index()
    {    

        $products = Product::paginate(3);
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {   

        $categories = Categories::all();
        $brands = Brands::all();
        return view('admin.product.create', compact('categories','brands'));
    }


    public function store(ProductFormRequest $request)
    {  

        $Validatedata = $request->validated();

        $categories = Categories::findOrFail($Validatedata['category_id']);


        $product = $categories->products()->create([
            'category_id' => $Validatedata['category_id'],
            'name' => $Validatedata['name'],
            'slug' => Str::slug($Validatedata['slug']),
            'brand' => $Validatedata['brand'],
            'small_description' => $Validatedata['small_description'],
            'description' => $Validatedata['description'],
            'original_price' => $Validatedata['original_price'],
            'selling_price' => $Validatedata['selling_price'],
            'trending' => $request->trending == true ? '1':'0',
            'status' => $request->status == true ? '1':'0',
            'meta_title' => $Validatedata['meta_title'],
            'meta_keyword' => $Validatedata['meta_keyword'],
            'meta_description' => $Validatedata['meta_description'],
            'quantity' => $Validatedata['quantity'],
        ]);
        if($request->hasFile('image'))
        {   
            $uploadPath = 'uploads/product/';
             $i =1;
            foreach ($request->file('image') as $imageFile) {
                $extention = $imageFile->getClientOriginalExtension();
                $filename = time().$i++.'.'.$extention;
                $imageFile->move($uploadPath,$filename);
                $finalImagePathName = $uploadPath.$filename;

                $product->product__images()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName,
                ]);
            }
        }
        return redirect('admin/product')->with('message', 'Book Created Successfully');

    }

    public function edit(int $product_id)
    {
        $products = Product::findOrFail($product_id);
        $categories = Categories::all();
        $brands = Brands::all();
        return view('admin.product.edit', compact('products','categories','brands'));
    }

    public function update(int $product_id, ProductFormRequest $request)
    {   

        $Validatedata = $request->validated();
        $products = Categories::findOrFail($Validatedata['category_id'])
        ->products()->where('id',$product_id)->first();


        if ($products) {
            $products ->update([
                'category_id' => $Validatedata['category_id'],
                'name' => $Validatedata['name'],
                'slug' => Str::slug($Validatedata['slug']),
                'brand' => $Validatedata['brand'],
                'small_description' => $Validatedata['small_description'],
                'description' => $Validatedata['description'],
                'original_price' => $Validatedata['original_price'],
                'selling_price' => $Validatedata['selling_price'],
                'trending' => $request->trending == true ? '1':'0',
                'status' => $request->status == true ? '1':'0',
                'meta_title' => $Validatedata['meta_title'],
                'meta_keyword' => $Validatedata['meta_keyword'],
                'meta_description' => $Validatedata['meta_description'],
                'quantity' => $Validatedata['quantity'],

            ]);
            if($request->hasFile('image'))
            {   
                $uploadPath = 'uploads/product/';

                $file = $request->file('image');
                $extention = $file->getClientOriginalExtension();
                $filename = time().'.'.$extention;
                $file->move($uploadPath, $filename);
                $finalImagePathName = $uploadPath.$filename;
                $category->image= $filename;
                $products->product__images()->update([
                    'product_id' => $products->id,
                    'image' => $finalImagePathName,
                ]);
            }
            return redirect('admin/product')->with('message', 'Book Update Successsfully');
        
        }   
        
    }

    public function destroy(int $product_id)
    {
        $products = Product::findOrFail($product_id);
        $products->delete();
        return redirect()->back()->with('message', 'Book Deleted Successsfully');

    }

    public function likePBook(int $product_id)
    {
        $products = Product::findOrFail($product_id);
        $products->like();
        $products->save();

        return redirect()->back()->with('message','Book Like successfully!');
    }
    public function unlikeBook(int $product_id)
    {
        $product = Product::findOrFail($product_id);
        $product->unlike();
        $product->save();
        
        return redirect()->back()->with('message','Book Like undo successfully!');
    }


}
