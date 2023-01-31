@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3> Add Book
                    <a href="{{ url('admin/dashboard/')}}" class="btn btn-danger btn-sm  text-white float-end"><i class="bi bi-house">Home</i></a>
                </h3>
            </div>
            <div class="card-body">
                @if ($errors->any())
                {
                   <div class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                      <div>{{$error}}</div>
                        
                    @endforeach
                   </div>
                }
                    
                @endif
                <form action="{{ url('admin/product/'.$products->id) }}" method="POST" enctype="multipart/form-data"> 
                    @csrf
                    @method('PUT')
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                        Home
                     </button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                        SEO Tags
                      </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                          Image
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">
                        Book Details
                       </button>
                    </li>
                  </ul>
                 <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home-tab-pane"name="category_id" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <div class="mb-3">
                            <label class="mb-3"> Product Category</label>
                            <select name="category_id" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                <option selected>Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}" {{$category->id == $products->category_id ? 'selected': '' }}>
                                  {{$category->name}}
                                </option> 
                                @endforeach
                                @error('category_id')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                              </select>
                            </div>
                        <div class="mb-3">
                            <label>Book Name</label>
                            <input type="text" name="name" class="form-control" value="{{$products->name}}"/>
                            @error('name')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                            
                        </div>
                        <div class="mb-3">
                            <label>Book Slug</label>
                            <input type="text" name="slug" class="form-control" value="{{$products->slug}}"/>
                            @error('brand')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                            
                        </div>
                        <div class="mb-3">
                            <label class="mb-3"> Book Brand</label>
                            <select class="form-select form-select-lg mb-3" name="brand" aria-label=".form-select-lg example">
                                <option selected>Select Brand</option>
                                @foreach ($brands as $brand)
                                <option value="{{$brand->name}}" {{$brand->name == $products->brand ? 'selected': '' }}>
                                  {{$brand->name}}
                                </option> 
                                @endforeach
                              </select>
                            </div>
                        <div class="mb-3">
                            <label>Small Description</label>
                            <textarea name="small_description" class="form-control">{{$products->small_description}}</textarea>
                            @error('small_description')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Book Description</label>
                            <textarea name="description" class="form-control" rows="6">{{$products->description}} </textarea>
                            @error('description')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="tab-pane fade" id="seo-tab-pane" role="tabpanel" aria-labelledby="seo-tab" tabindex="0">
                        <div class="mb-3">
                            <label>Meta Title</label>
                            <input type="text" name="meta_title" class="form-control" value="{{$products->meta_title}} "/>
                            @error('meta_title')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                            
                        </div>
                        <div class="mb-3">
                            <label>Meta Description</label>
                            <textarea name="meta_description" class="form-control" rows="6">{{$products->meta_description}}</textarea>
                            @error('description')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Meta keyword</label>
                            <textarea name="meta_keyword" class="form-control">{{$products->meta_keyword}}</textarea>
                            @error('meta_keyword')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="tab-pane fade" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">
                        <div class="mb-3">
                            <label>Book Image</label>
                            <input type="file" name="image"  class="form-control"/>
                            <div>
                                @if ($products->product__images)
                                @foreach($products->product__images as $image)
                                <img src="{{ asset($image->image) }}" style="height: 80px;width:80px;"
                                class="me-4"/>
                                @endforeach
                                @else
                                    <h5>No Book</h5>
                                @endif
                            </div>
                            @error('image')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                            
                        </div>
            
                    </div>
                    <div class="tab-pane fade" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Original Price</label>
                                <input type="text" name="original_price" class="form-control" value="{{$products->original_price}}" />
                                @error('meta_title')<strong class="text-danger">{{$message}}</strong>@enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Selling Price</label>
                                    <input type="text" name="selling_price" class="form-control" value="{{$products->selling_price}}"/>
                                    @error('selling_price')<strong class="text-danger">{{$message}}</strong>@enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Quantity</label>
                                    <input type="text" name="quantity" class="form-control" value="{{$products->quantity}}"/>
                                    @error('quantity')<strong class="text-danger">{{$message}}</strong>@enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Trending</label>
                                    <input type="checkbox" name="trending"/>
                                    @error('trending')<strong class="text-danger">{{$message}}</strong>@enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Status</label>
                                    <input type="checkbox" name="status"/>
                                    @error('status')<strong class="text-danger">{{$message}}</strong>@enderror
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                 </div>
                </form>
              
            </div>
        </div>
    </div>
</div>




@endsection
