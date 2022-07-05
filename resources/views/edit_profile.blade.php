@extends('layout')

@section('content')

    <main>
        <div class="container-fluid px-4">
            
            
            <h2 class="mt-4">Edit Profile</h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.profile') }}">Profile</a></li>
                <li class="breadcrumb-item active">Edit Profile</li>
            </ol>
            
            <div class="card mb-4">
                <div class="card-body">
                    <div class="container">
                        <form action="{{ route('admin.profile.update', $user->id) }}" method="POST">
                            <div class="row">
                                <!--<div class="col-md-6">-->
                                    @csrf
                                    <div class="form-group my-2 col-md-6">
                                        <label for="Name">Name</label>
                                        <input type="text" name="name" value="{{ $user->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Name" autocomplete="off">
                                        <div class="invalid-feedback">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group my-2 col-md-6">
                                        <label for="Email">Admin Email</label>
                                        <input type="text" name="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email" autocomplete="off">
                                        <div class="invalid-feedback">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                     
                                <!--</div>-->
                            </div>


<div class="row">
                                    <div class="form-group my-2 col-md-6">
                                        <label for="address">Address</label>
                                        <input type="text" name="address" value="{{ $user->address}}" class="form-control @error('name') is-invalid @enderror" placeholder="Address" autocomplete="off">
                                        <div class="invalid-feedback">
                                            @error('category')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group my-2 col-md-6">
                                       <label for="phoneno">Phone No</label>
                                        <input type="text" name="phoneno" value="{{ $user->phoneno }}" class="form-control @error('name') is-invalid @enderror" placeholder="phoneno" autocomplete="off">
                                        <div class="invalid-feedback">
                                            @error('subcategory')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group my-2 col-md-6">
                                        <label for="fax">Fax</label>
                                        <input type="text" name="fax" value="{{ $user->fax}}" class="form-control @error('name') is-invalid @enderror" placeholder="fax" autocomplete="off">
                                        <div class="invalid-feedback">
                                            @if (Session::has('title_error'))
                                                {{ Session::get('title_error') }}
                                            @endif
                                            
                                        </div>

                                    </div>
                                    <div class="form-group my-2 col-md-6">
                                        <label for="contactemail">Contact Email</label>
                                        <input type="text" name="contactemail" value="{{ $user->contactemail }}" class="form-control @error('name') is-invalid @enderror" placeholder="contactemail" autocomplete="off">
                                        <div class="invalid-feedback">
                                            @error('canonical_name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>

<div class="row">
                                    <div class="form-group my-2 col-md-6">
                                        <label for="openingdates">Opening Dates</label>
                                        <input type="text" name="openingdates" value="{{ $user->openingdates }}" class="form-control @error('name') is-invalid @enderror" placeholder="openingdates" autocomplete="off">
                                        <div class="invalid-feedback">
                                            @if (Session::has('title_error'))
                                                {{ Session::get('title_error') }}
                                            @endif
                                            
                                        </div>

                                    </div>
                                    <div class="form-group my-2 col-md-6">
                                        <label for="closingdates">Closing Dates</label>
                                        <input type="text" name="closingdates" value="{{ $user->closingdates }}" class="form-control @error('name') is-invalid @enderror" placeholder="closingdates" autocomplete="off">
                                        <div class="invalid-feedback">
                                            @error('canonical_name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>


<div class="row">






                            <button type="submit" class="btn btn-primary my-3">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main> 
@endsection

@push('script')
 
@endpush