@extends('layout')

@section('content')

    <main>
        <div class="container-fluid px-4">

            <h1 class="mt-4">Testimonial Details</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('testimonial.index') }}">Testimonial</a></li>
                <li class="breadcrumb-item active">Testimonial Details</li>
            </ol>
            
            <div class="card mb-4">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <p class="col-md-6">Name :</p>
                                    <p class="col-md-6">{{ $testimonial->name }}</p>
                                </div>
                                <div class="row">
                                    <p class="col-md-6">Designation :</p>
                                    <p class="col-md-6">{{ $testimonial->designation }}</p>
                                </div>
                                <div class="row">
                                    <p class="col-md-6">Description :</p>
                                    <p class="col-md-6">{{ $testimonial->description }}</p>
                                </div>
                                <div class="row">
                                    <p class="col-md-6">Status :</p>
                                    <p class="col-md-6"><?php if ($testimonial->status=='0'){?>InActive<?php } else {?> Active

    <?php }?></p>
                                </div>
                                <div class="row">
                                    <p class="col-md-6">Sort Order :</p>
                                    <p class="col-md-6">{{ $testimonial->sortorder }}</p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main> 
@endsection
