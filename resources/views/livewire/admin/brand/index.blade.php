<div>
    @include('livewire.admin.brand.model-form')

    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
                
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Brands list
                        <a href="#" data-bs-toggle="modal" data-bs-target="#addbrandsModal" class="btn btn-primary btn-sm float-end">Add Brands</a>
                        
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <p class="card-title">PRODUCT BRANDS</p>
                              <div class="table-responsive">
                                <table id="recent-purchases-listing" class="table">
                                  <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($brands as $brand)
                                        
                                    <tr> 
                                        <td>{{$brand->id}}</td>
                                        <td>{{$brand->name}}</td>
                                        <td >{{$brand->Status == '1' ? 'Hidden':'Visible'}}</td>
                                        <td> 
                                          <a href="#" wire:click="editBrand({{$brand->id}})" data-bs-toggle="modal" data-bs-target="#updatebrandsModal" class="btn btn-success btn-lg">Edit</a>
                                            <a href="#" wire:click="deletebrand({{$brand->id}})" data-bs-toggle="modal" data-bs-target="#deleteBrandModal" class="btn btn-danger btn-lg">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach  
                                  </tbody>
                                </table>
                                {{ $brands->links() }}
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

    $('#addbrandsModal').modal('hide');
    $('#updatebrandsModal').modal('hide');
    $('#deleteBrandModal').modal('hide');

  });
</script>
    
@endpush
