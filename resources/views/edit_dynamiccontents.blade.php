@extends('layout')

@section('content')

    <main>
        <div class="container-fluid px-4">
            
            
            <h2 class="mt-4">Edit Contents</h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{'/admin/dynamiccontents/1'}}">Contents</a></li>
                <li class="breadcrumb-item active">Edit Contents</li>
            </ol>
            
            <div class="card mb-4">
                <div class="card-body">
                    <div class="container">
                        <form action="{{ route('admin.dynamiccontents.update', $contents->id) }}" method="POST">@csrf
                            

<div class="row">
                                    <div class="form-group my-2 col-md-6">
                                        <label for="Firstpagebannertitle1">Firstpagebannertitle1</label>
                                        <input type="text" name="firstpagebannertitle1" value="{{ $contents->firstpagebannertitle1 }}" class="form-control @error('name') is-invalid @enderror" placeholder="Firstpagebannertitle1" autocomplete="off">
                                        <div class="invalid-feedback">
                                            @error('category')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group my-2 col-md-6">
                                       <label for="Name">Firstpagebannertitle2</label>
                                        <input type="text" name="firstpagebannertitle2" value="{{ $contents->firstpagebannertitle2 }}" class="form-control @error('name') is-invalid @enderror" placeholder="firstpagebannertitle2" autocomplete="off">
                                        <div class="invalid-feedback">
                                            @error('subcategory')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group my-2 col-md-6">
                                        <label for="firstcolumntitle1">Firstcolumntitle1</label>
                                        <input type="text" name="firstcolumntitle1" value="{{ $contents->firstcolumntitle1}}" class="form-control @error('name') is-invalid @enderror" placeholder="firstcolumntitle1" autocomplete="off">
                                        <div class="invalid-feedback">
                                            @if (Session::has('title_error'))
                                                {{ Session::get('title_error') }}
                                            @endif
                                            
                                        </div>

                                    </div>
                                    <div class="form-group my-2 col-md-6">
                                        <label for="firstcolumntitle2">Firstcolumntitle2</label>
                                        <input type="text" name="firstcolumntitle2" value="{{ $contents->firstcolumntitle2 }}" class="form-control @error('name') is-invalid @enderror" placeholder="firstcolumntitle2" autocomplete="off">
                                        <div class="invalid-feedback">
                                            @error('canonical_name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>

<div class="row">
                                    <div class="form-group my-2 col-md-6">
                                        <label for="firstcolumntitle3">Firstcolumntitle3</label>
                                        <input type="text" name="firstcolumntitle3" value="{{ $contents->firstcolumntitle3 }}" class="form-control @error('name') is-invalid @enderror" placeholder="firstcolumntitle3" autocomplete="off">
                                        <div class="invalid-feedback">
                                            @if (Session::has('title_error'))
                                                {{ Session::get('title_error') }}
                                            @endif
                                            
                                        </div>

                                    </div>
                                    <div class="form-group my-2 col-md-6">
                                        <label for="secondcolumntitle">Secondcolumntitle</label>
                                        <input type="text" name="secondcolumntitle" value="{{ $contents->secondcolumntitle }}" class="form-control @error('name') is-invalid @enderror" placeholder="secondcolumntitle" autocomplete="off">
                                        <div class="invalid-feedback">
                                            @error('canonical_name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>


<div class="row">
                                    <div class="form-group my-2 col-md-6">
                                        <label for="secondcolumncontent">Secondcolumncontent</label>
                                        <textarea name="secondcolumncontent" class="form-control {{ Session::has('description_error') ? 'is-invalid' : '' }}" cols="30" rows="3" placeholder="secondcolumncontent" autocomplete="off">{{ $contents->secondcolumncontent }}</textarea>
                                        <div class="invalid-feedback">
                                            @if (Session::has('title_error'))
                                                {{ Session::get('title_error') }}
                                            @endif
                                            
                                        </div>

                                    </div>
                                    <div class="form-group my-2 col-md-6">
                                        <label for="thirdcolumntitle">Thirdcolumntitle</label>
                                        <input type="text" name="thirdcolumntitle" value="{{ $contents->thirdcolumntitle }}" class="form-control @error('name') is-invalid @enderror" placeholder="thirdcolumntitle" autocomplete="off">
                                        <div class="invalid-feedback">
                                            @error('canonical_name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>


<div class="row">
                                    <div class="form-group my-2 col-md-6">
                                        <label for="Thirdcolumncontent">Thirdcolumncontent</label>
                                        <textarea name="thirdcolumncontent" class="form-control {{ Session::has('description_error') ? 'is-invalid' : '' }}" cols="30" rows="3" placeholder="Thirdcolumncontent" autocomplete="off">{{ $contents->thirdcolumncontent }}</textarea>
                                        <div class="invalid-feedback">
                                            @if (Session::has('title_error'))
                                                {{ Session::get('title_error') }}
                                            @endif
                                            
                                        </div>

                                    </div>
                                    <div class="form-group my-2 col-md-6">
                                        <label for="footertitle">Footertitle</label>
                                        <input type="text" name="footertitle" value="{{ $contents->footertitle }}" class="form-control @error('name') is-invalid @enderror" placeholder="footertitle" autocomplete="off">
                                        <div class="invalid-feedback">
                                            @error('canonical_name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>


<div class="row">
                                    <div class="form-group my-2 col-md-6">
                                        <label for="footercontent">Footercontent</label>
                                        <textarea name="footercontent" class="form-control {{ Session::has('description_error') ? 'is-invalid' : '' }}" cols="30" rows="3" placeholder="Footercontent" autocomplete="off">{{ $contents->footercontent }}</textarea>
                                        <div class="invalid-feedback">
                                            @if (Session::has('title_error'))
                                                {{ Session::get('title_error') }}
                                            @endif
                                            
                                        </div>

                                    </div>
                                    <div class="form-group my-2 col-md-6">
                                        <label for="secondpagebannertitle1">Secondpagebannertitle1</label>
                                        <input type="text" name="secondpagebannertitle1" value="{{ $contents->secondpagebannertitle1 }}" class="form-control @error('name') is-invalid @enderror" placeholder="secondpagebannertitle1" autocomplete="off">
                                        <div class="invalid-feedback">
                                            @error('canonical_name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>

<div class="row">
                                    <div class="form-group my-2 col-md-6">
                                        <label for="secondpagebannertitle2">Secondpagebannertitle2</label>
                                        <input type="text" name="secondpagebannertitle2" value="{{ $contents->secondpagebannertitle2 }}" class="form-control @error('name') is-invalid @enderror" placeholder="Secondpagebannertitle2" autocomplete="off">
                                        <div class="invalid-feedback">
                                            @if (Session::has('title_error'))
                                                {{ Session::get('title_error') }}
                                            @endif
                                            
                                        </div>

                                    </div>
                                    <div class="form-group my-2 col-md-6">
                                        <label for="secondpagebannertitle3">Secondpagebannertitle3</label>
                                        <input type="text" name="secondpagebannertitle3" value="{{ $contents->secondpagebannertitle3 }}" class="form-control @error('name') is-invalid @enderror" placeholder="secondpagebannertitle3" autocomplete="off">
                                        <div class="invalid-feedback">
                                            @error('canonical_name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>

<div class="row">
                                    <div class="form-group my-2 col-md-6">
                                        <label for="bottompagelefttitle">BottompageLefttitle</label>
                                        <input type="text" name="bottompagelefttitle" value="{{ $contents->bottompagelefttitle }}" class="form-control @error('name') is-invalid @enderror" placeholder="bottompagelefttitle" autocomplete="off">
                                        <div class="invalid-feedback">
                                            @if (Session::has('title_error'))
                                                {{ Session::get('title_error') }}
                                            @endif
                                            
                                        </div>

                                    </div>
                                    <div class="form-group my-2 col-md-6">
                                        <label for="bottompageleftcontent">BottompageLeftcontent</label>
                                        <textarea name="bottompageleftcontent" class="form-control {{ Session::has('description_error') ? 'is-invalid' : '' }}" cols="30" rows="3" placeholder="bottompageleftcontent" autocomplete="off">{{ $contents->bottompageleftcontent }}</textarea>
                                        <div class="invalid-feedback">
                                            @error('canonical_name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>


<div class="row">
                                    <div class="form-group my-2 col-md-6">
                                        <label for="bottompagerighttitle">BottompageRighttitle</label>
                                        <input type="text" name="bottompagerighttitle" value="{{ $contents->bottompagerighttitle }}" class="form-control @error('name') is-invalid @enderror" placeholder="bottompagerighttitle" autocomplete="off">
                                        <div class="invalid-feedback">
                                            @if (Session::has('title_error'))
                                                {{ Session::get('title_error') }}
                                            @endif
                                            
                                        </div>

                                    </div>
                                    <div class="form-group my-2 col-md-6">
                                        <label for="bottompagerightContent">BottompageRightContent</label>
                                        <textarea name="bottompagerightContent" class="form-control {{ Session::has('description_error') ? 'is-invalid' : '' }}" cols="30" rows="3" placeholder="bottompagerightContent" autocomplete="off">{{ $contents->bottompagerightContent }}</textarea>
                                        <div class="invalid-feedback">
                                            @error('canonical_name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>


<div class="row">
                                    <div class="form-group my-2 col-md-6">
                                        <label for="faqContent">FaqContent</label>
                                        <textarea name="faqContent" class="form-control {{ Session::has('description_error') ? 'is-invalid' : '' }}" cols="30" rows="3" placeholder="faqContent" autocomplete="off">{{ $contents->faqContent }}</textarea>
                                        <div class="invalid-feedback">
                                            @if (Session::has('title_error'))
                                                {{ Session::get('title_error') }}
                                            @endif
                                            
                                        </div>

                                    </div>
                                    <div class="form-group my-2 col-md-6">
                                        <label for="enquiryContent">EnquiryContent</label>
                                        <textarea name="enquiryContent" class="form-control {{ Session::has('description_error') ? 'is-invalid' : '' }}" cols="30" rows="3" placeholder="enquiryContent" autocomplete="off">{{ $contents->enquiryContent }}</textarea>
                                        <div class="invalid-feedback">
                                            @error('canonical_name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>

  <div class="row">

                                <div class="form-group my-2 col-md-12">
                                        <label for="howitworksContent">How it works Content</label>
                                        <textarea name="editor1" id="editor1" class="form-control {{ Session::has('description_error') ? 'is-invalid' : '' }}" cols="30" rows="3" placeholder="HowitworksContent" autocomplete="off">{{ $contents->howitworks }}</textarea>
                                        <div class="invalid-feedback">
                                            @error('canonical_name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                </div>


<div class="row">

                                <div class="form-group my-2 col-md-12">
                                        <label for="aboutusContent">About Us</label>
                                        <textarea name="editor2" id="editor2" class="form-control {{ Session::has('description_error') ? 'is-invalid' : '' }}" cols="30" rows="3" placeholder="About Us Content" autocomplete="off">{{ $contents->aboutus }}</textarea>
                                        <div class="invalid-feedback">
                                            @error('canonical_name')
                                                {{ $message }}
                                            @enderror
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
 <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
<script>
   $(window).on('load', function (){
    //$( '#editor1' ).ckeditor();
    CKEDITOR.replace('editor1');
    CKEDITOR.replace('editor2');
});
   </script>
@endpush