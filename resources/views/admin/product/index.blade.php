@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
            
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Book Management
                    <a href="{{ url('admin/product/create')}}" class="btn btn-primary btn-sm float-end">Add Book</a>
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 stretch-card">
                      <div class="card">
                        <div class="card-body">
                          <p class="card-title">Book LIST</p>
                          <div class="table-responsive">
                            <table id="recent-purchases-listing" class="table">
                              <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Book Name</th>
                                    <th>Book Category</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    @if ($product->category)
                                    <td>{{$product->category->name}}
                                    @else
                                        No Book Category
                                    @endif
                                    </td>
                                    <td >{{$product->Status == '1' ? 'Hidden':'Visible'}}</td>
                                    <td>
                                        <a href="{{ url('admin/product/'.$product->id.'/edit')}}" class="btn btn-success btn-lg">Edit</a>
                                        <a href="{{ url('admin/product/'.$product->id.'/delete')}}" onclick="return confirm('Are you sure, you want to delete this data')" class="btn btn-danger btn-lg">Delete</a>
                                    </td> 
                                    {{-- <td class="px-6 py-4 text-sm text-gray-500 border-b border-gray-200 ">
                                      <form action="{{ url('admin/product/'.$product->id.'/like')}} }}"method="post">
                                        @csrf
                                        <button class="{{ $products->liked() ? 'bg-blue-600' : '' }} px-4 py-2 text-white bg-gray-600">
                                          like {{ $products->likeCount }}</button>
                                      </form>

                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 border-b border-gray-200 ">
                                      <form action="{{ url('admin/product/'.$product->id.'/unlike')}} }}"method="post">
                                        @csrf
                                        <button class="{{ $products->liked() ? 'block' : 'hidden'  }} px-4 py-2 text-white bg-red-600">
                                          unlike </button>
                                      </form>

                                    </td> --}}
                                </tr>
                                
                              
                                @endforeach
                              </tbody>
                            </table>
                            {!! $products->withQueryString()->links('pagination::bootstrap-5') !!}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
  </div>
</div>

@push('script')

<script>
  window.addEventListener('close-model', event =>{

    $('#deleModel').modal('hide');

  });
</script>
    
@endpush

@endsection