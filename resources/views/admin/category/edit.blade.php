@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3> Edit Category
                    <a href="{{ url('admin/category')}}" class="btn btn-primary btn-sm  text-white float-end"><i class="bi bi-house">Back</i></a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/category/'.$category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Name</label>
                        <input type="text" name="name" value="{{$category->name}}" class="form-control" placeholder="Enter Category Name" />
                        @error('name')
                            <strong class="text-danger">{{$message}}</strong>
                          
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Slug</label>
                        <input type="text" name="slug" value="{{$category->slug}}" class="form-control" placeholder="Enter Slug" />
                        @error('slug')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                        
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Image</label>
                        
                        <input type="file" name="image" class="form-control" />
                        <img src="{{ asset('/uploads/category/'.$category->image)}} "class="rounded" height="100px;">
                        @error('image')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Status</label>
                        <input type="checkbox" name="Status" value="{{$category->status == '1' ? 'checked':'' }}" />
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="6" placeholder="Enter Description">{{$category->description}}</textarea>
                        @error('description')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary float-end">Update</button>
                    </div>
                   </div>
                </form>
            </div>
        </div>
    </div>
</div>




@endsection