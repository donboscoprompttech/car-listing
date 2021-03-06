@extends('layout')

@section('content')

    <main>
        <div class="container-fluid px-4">
            
            <a href="#" data-toggle="modal" data-target="#createBannerModal"><button type="button" class="btn btn-primary float-end">Create Model</button></a>
            
            <h2 class="mt-4">Model</h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Model</li>
            </ol>
            
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Model
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Model</th>
                                <th>Make</th>
                                 <th>Status</th>
                                <th>Sort Order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $row)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $row->name }}</td> <td>{{ $row->makename }}</td>
                                    <td><?php if ($row->status=='0'){?>InActive<?php } else {?> Active

    <?php }?></td><td>{{ $row->sort_order }}</td>

                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu text-center">
                                                <button class="btn btn-secondary" onclick="editBanner({{$row->id}}, `{{$row->name}}`, {{$row->status}},{{$row->sort_order}},`{{$row->make_id}}`)" data-toggle="modal" data-target="#editBannerModal">Edit</button>
                                                <button type="button" onclick="bannerDelete({{$row->id}})" class="btn btn-danger" data-toggle="modal" data-target="#deleteBannerModal">Delete</button>
                                                <form id="delete_Banner_form{{$row->id}}" action="{{ route('model.delete', $row->id) }}" method="POST">
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main> 
@endsection

@push('script')
    
<div class="modal fade" id="deleteBannerModal" tabindex="-1" role="dialog" aria-labelledby="deleteBannerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
          {{-- <h5 class="modal-title" id="deleteBannerModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span> --}}
          {{-- </button> --}}
            </div>
            <div class="modal-body">
                Are you sure, do you want to delete?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" onclick="deteteBanner()" class="btn btn-primary">Delete</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createBannerModal" tabindex="-1" role="dialog" aria-labelledby="createBannerModalModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('model.store') }}" method="POST" enctype="multipart/form-data" id="privacyStore">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="createBannerModalModalLabel">Create Model</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="form-group my-2">
                            <label for="Name">Name</label>
                           <input type="text" value="{{ old('name') }}" name="name" class="form-control" id="Name" placeholder="Name" required>
                        </div>

                        <div class="form-group my-2">
                            <label for="status">Make</label>
                             <select name="make" id="make" class="form-control" required>
                                <option value="">Select Make</option>
                                <?php foreach($make as $mk){?>
                               <option value="<?php echo $mk->id;?>"><?php echo $mk->name;?></option>
                               <?php } ?>
                               
                               
                            </select>
                        </div>





                        <div class="form-group my-2">
                            <label for="status">Status</label>
                             <select name="status" id="" class="form-control" required>
                                <option value="">Select Status</option>
                               <option value="1">Active</option>
                               <option value="0">InActive</option>
                               
                            </select>
                        </div>
                        <div class="form-group my-2">
                            <label for="sort">Sort Order</label>
                           
                            <input type="text" required value="{{ old('sortorder') }}" name="sortorder" class="form-control" id="SortOrder" placeholder="SortOrder">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editBannerModal" tabindex="-1" role="dialog" aria-labelledby="editBannerModalModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('model.update') }}" method="POST" enctype="multipart/form-data" id="editPrivacyForm">
                @csrf
                <input type="hidden" name="id" id="editId">
                <div class="modal-header">
                <h5 class="modal-title" id="createBannerModalModalLabel">Update Model</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                         <div class="form-group my-2">
                            <label for="Name">Name</label>
                           <input type="text" value="{{ old('name') }}"  required name="name" class="form-control"  placeholder="Name" id="name1">
                        </div>

                        <div class="form-group my-2">
                            <label for="status">Make</label>
                             <select name="make" id="make1" class="form-control" required>
                                <option value="">Select Make</option>
                                <?php foreach($make as $mk){?>
                               <option value="<?php echo $mk->id;?>"><?php echo $mk->name;?></option>
                               <?php } ?>
                               
                               
                            </select>
                        </div>





                        <div class="form-group my-2">
                           <label for="status">Status</label>
                             <select name="status" id="status1" required class="form-control">
                                <option value="">Select Status</option>
                               <option value="1">Active</option>
                               <option value="0">InActive</option>
                               
                            </select>
                        </div>
                        <div class="form-group my-2">
                           <label for="sort">Sort Order</label>
                           
                            <input type="text" required name="sortorder" class="form-control" id="SortOrder1" placeholder="SortOrder">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

  <script>

        $('form[id="privacyStore"]').validate({
            rules : {
                title: {
                        required : true,
                    },
                privacy: {
                        required: true,
                    },
            },
            submitHandler: function(form) {
                form.submit();
            }
        });

        $('form[id="editPrivacyForm"]').validate({
            rules : {
                title: {
                        required : true,
                    },
                privacy: {
                        required: true,
                    },
            },
            submitHandler: function(form) {
                form.submit();
            }
            
        });

        editBanner = (id, name, status,sortorder,make) => {
            console.log(id);
            $('#editId').val(id);
            $('#name1').val(name);
            $('#make1').val(make);
            $('#status1').val(status);
            $('#SortOrder1').val(sortorder);
        }
        
        let ids = '';

        bannerDelete = id => {
            ids = id;
        }

        deteteBanner = () => {
            
            $('#delete_Banner_form'+ids).submit();
        }

  </script>

@if (Session::has('success'))
<script>
    Swal.fire({
        icon: 'success',
        text: '{!! Session::get('success') !!}',
    })
</script>
@endif

@if (Session::has('error'))
<script>
    Swal.fire({
        icon: 'error',
        text: '{!! Session::get('error') !!}',
    })
</script>
@endif
@endpush