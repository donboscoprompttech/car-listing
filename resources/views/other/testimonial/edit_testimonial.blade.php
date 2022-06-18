@extends('layout')

@section('content')

    <main>
        <div class="container-fluid px-4">
            
            
            <h2 class="mt-4">Edit Testimonial</h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('testimonial.index') }}">Testimonial</a></li>
                <li class="breadcrumb-item active">Edit Testimonial</li>
            </ol>
            
            <div class="card mb-4">
                <div class="card-body">
                    <div class="container">
                        <form action="{{ route('testimonial.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data" id="testimonial">
                            <div class="row">
                                <div class="col-md-6">
                                    @csrf
                                    <div class="form-group my-2">
                                        <label for="SortOrder">Name</label>
                                        
                                        <input type="text" name="name" value="{{ $testimonial->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Name" autocomplete="off"> 
                                        <div class="invalid-feedback">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group my-2">
                                        <label for="status">Status</label>
                             <select name="status" id="" class="form-control">
                                <option value="">Select Status</option>
                               <option value="1" <?php if ($testimonial->status=='1'){?>selected <?php } ?>>Active</option>
                               <option value="0" <?php if ($testimonial->status=='0'){?>selected <?php } ?>>InActive</option>
                               
                            </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group my-2">
                                        <label for="Name">Designation</label>
                                        <input type="text" name="designation" value="{{ $testimonial->designation }}" class="form-control @error('designation') is-invalid @enderror" placeholder="Designation" autocomplete="off">
                                        <div class="invalid-feedback">
                                            @error('designation')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Description">Description</label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="1" placeholder="Description" autocomplete="off">{{ $testimonial->description }}</textarea>
                                        <div class="invalid-feedback">
                                            @error('description')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary my-3">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main> 
@endsection

@push('script')
    <script>
        $('form[id="testimonial"]').validate({
            rules : {
                name: {
                        required : true,
                    },
                designation: {
                        required: true,
                    },
                description: {
                        required: true,
                    },
                },

            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
@endpush
