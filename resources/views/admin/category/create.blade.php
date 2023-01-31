@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3> Add Category
                    <a href="{{ url('admin/dashboard/')}}" class="btn btn-danger btn-sm  text-white float-end"><i class="bi bi-house">Back</i></a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/category') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Category Name" />
                        @error('name')
                            <strong class="text-danger">{{$message}}</strong>
                          
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Slug</label>
                        <input type="text" name="slug" class="form-control" placeholder="Enter Slug" />
                        @error('slug')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                        
                    </div>
                    {{-- <div class="col-md-6 mb-3">
                        <label>Status</label>
                        <input type="text" name="Status" class="form-control" placeholder="Enter Status" />
                    </div> --}}
                    <div class="col-md-6 mb-3">
                        <label>Image</label>
                        
                        <input type="file" name="image" class="form-control" />
                        @error('image')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="6" placeholder="Enter Description"></textarea>
                        @error('description')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary float-end">Submit</button>
                    </div>
                   </div>
                </form>
            </div>
        </div>
    </div>
</div>




@endsection