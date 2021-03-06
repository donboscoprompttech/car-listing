<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Details</title>
    <!-- Favicon-->
    <!--<link rel="icon" type="image/x-icon" href="assets/images/logo.png" />-->
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    
    <link href="{{ asset('/car/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('/car/css/main.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Select2 Plugin css -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.css">

    <!-- Slick slider -->
    
    <link href="{{ asset('/car/css/slick/slick.css') }}" rel="stylesheet"> 
    <link href="{{ asset('/car/css/slick/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('/car/js/fotorama.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('car/css/developer.css') }}" />
</head>

<body>
    <!-- Navigation-->
         @include('cars.header')

    <!-- Header -->
    <header class="bg-dark gvr-header listing-header">
        <div class="header-div">
            <p class="title">{{$vehicletypecars->title}}</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Details</a></li>
                </ol>
            </nav>
        </div>
    </header>

    <section class="details-section">
        <div class="container-fluid">
            <div class="details-div">
                <div class="gallery-div">
                    <div class="fotorama" data-allowfullscreen="true">
                    @foreach ($vehicleimages as $row)
                    <?php if($row->vehicleaudio==1){?><a href="{{ asset($row->image) }}" data-video="true" class="video-gal"> <?php }else {?>
                    <a href="{{ asset('car/1.jpg') }}"> <img src="{{ asset($row->image) }}"> </a>
                <?php }?>
                        
                        @endforeach
                            <!--<img src="{{----asset('car/assets/images/listing/details/1.png')----}}">-->

                            <img src="{{ asset($row->image) }}">
                        </a>
                    </div>
                    <div class="data-div">
                        <div class="name-div">
                            <p>{{$vehicletypecars->title}}</p>
                        </div>
                        <div class="tag-div" style="width:30%">
                            <p style="width:auto">{{$vehicletypecars->soldreserved}}-{{$vehicletypecars->uniquenumber}}</p>
                           
                        </div>
                        <div class="desc-div">
                            <p class="desc">{{$vehicletypecars->description}}
                                
                            </p>
                        </div>
                        <div class="price-div">
                            <p>AED
                                {{number_format($vehicletypecars->price)}}
                            </p>
                        </div>
                        <div class="info-div">
                            <div class="detail">
                                <p><span><img src="{{ asset('car/assets/images/Icons/calendar.png') }}" class="img-fluid detail-icon" alt=""><img src="assets/images/Icons/calendar.png" class="img-fluid detail-icon"
                                            alt=""></span>{{$vehicletypecars->registration_year}}</p>
                            </div>
                            <div class="detail">
                                <p><span><img src="{{ asset('car/assets/images/Icons/wheel.png') }}" class="img-fluid detail-icon"
                                            alt=""></span>{{$vehicletypecars->drive}}</p>
                            </div>
                            <div class="detail">
                                <p><span><img src="{{ asset('car/assets/images/Icons/fuel.png') }}" class="img-fluid detail-icon"
                                            alt=""></span>{{$vehicletypecars->fuel_type}}</p>
                            </div>
                            <div class="detail">
                                <p><span><img src="{{ asset('car/assets/images/Icons/people.png') }}" class="img-fluid detail-icon"
                                            alt=""></span>{{$vehicletypecars->seats}}</p>
                            </div>
                        </div>
                        <div class="location-div">
                            <p>{{$vehicletypecars->placename}},{{$vehicletypecars->countryname}}</p>
                        </div>
                        <div class="button-div">
                            <?php if ($vehicletypecars->phone_hide_flag==0){?>
                            <button class="btn call-btn"><i class="fa-solid fa-phone-volume"></i>{{$vehicletypecars->phone}}</button>
                        <?php }?>
                            <a href="#jump" ><button class="btn enquiry-btn"><span><img src="{{ asset('car/assets/images/Icons/enquiry.svg') }}"
                                        class="img-fluid detail-icon" alt=""></span>Enquire Now</button></a>
                        </div>
                    </div>
                </div>
               
            </div>
            <div class="tab-div">
                <div class="list-tab-div">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="desc-tab" data-bs-toggle="tab"
                                data-bs-target="#description" type="button" role="tab" aria-controls="home"
                                aria-selected="true">Description</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="motor-tab" data-bs-toggle="tab" data-bs-target="#motor"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">Motor
                                Info</button>
                        </li>
<?php if (count($features)!=0){?>
<li class="nav-item" role="presentation">
                            <button class="nav-link" id="motor-tab" data-bs-toggle="tab" data-bs-target="#motorfeatures"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">Features</button>
                        </li><?php } ?>


<li class="nav-item" role="presentation">
                            <button class="nav-link" id="motor-tabint" data-bs-toggle="tab" data-bs-target="#motorinterior"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">Interior</button>
                        </li>

<li class="nav-item" role="presentation">
                            <button class="nav-link" id="motor-tabext" data-bs-toggle="tab" data-bs-target="#motorexterior"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">Exterior</button>
                        </li>



                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="location-tab" data-bs-toggle="tab" data-bs-target="#location"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">Location</button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel"
                        aria-labelledby="description-tab">
                        <div class="container-fluid">
                            <div class="desc-content">
                                <p class="heading">{{$vehicletypecars->longdescrptitle}}</p>
                                <p class="desc">"{{$vehicletypecars->longdescrp}}"</p>
                            </div>
                            
                        </div>
                    </div>
                    <div class="tab-pane fade" id="motor" role="tabpanel" aria-labelledby="motor-tab">
                        <div class="motor-details">
                            <p class="title">Car Details</p>
                            <ul>
                                <li>
                                    <p>Make <span>{{$vehicletypecars->makename}}</span></p>
                                </li>
                                <li>
                                    <p>Model <span>{{$vehicletypecars->modelname}}</span></p>
                                </li>
                                <li>
                                    <p>Condition <span>{{$vehicletypecars->condition}}</span></p>
                                </li>
                                <li>
                                    <p>Year <span>{{$vehicletypecars->registration_year}}</span></p>
                                </li>
                                <li>
                                    <p>Body Type <span>-{{$vehicletypecars->bodyname}}-</span></p>
                                </li>
                                <li>
                                    <p>Seats <span>{{$vehicletypecars->seats}} people</span></p>
                                </li>
                                <li>
                                    <p>Exterior Color<span>{{$vehicletypecars->exteriorcolor}}</span></p>
                                </li>
                                <li>
                                    <p>Transmission<span>{{$vehicletypecars->transmission}}</span></p>
                                </li>
                            </ul>
                        </div>                        
                    </div>
<?php if (count($features)!=0){?>
<div class="tab-pane fade" id="motorfeatures" role="tabpanel" aria-labelledby="motor-tabint">
                         <div class="motor-details">
                            <p><b> Feature Details</b></p>

<ul>
    <?php 
    foreach($features as $feat){?>
                                <li>
                                    <p><?php echo $feat->featuresname;?><span><?php echo "Yes";?></span></p>
                                </li>
                                <?php }?>
                            </ul>                            
                        </div>
                    </div>
<?php } ?>





<div class="tab-pane fade" id="motorinterior" role="tabpanel" aria-labelledby="motor-tabint">
                         <div class="motor-details">
                            <p><b> Interior Details</b></p>

<ul>
    <?php 
    foreach($vehicleinterior as $int){?>
                                <li>
                                    <p><?php echo $int->label;?><span><?php echo $int->value;?></span></p>
                                </li>
                                <?php }?>
                            </ul>                            
                        </div>
                    </div>

<div class="tab-pane fade" id="motorexterior" role="tabpanel" aria-labelledby="motor-tabext">
                        <div class="motor-details">
                            <p> <b>Exterior Details</b></p>
                            <ul>
                                <?php 



    foreach($vehicleexterior as $ext){?>
                                <li>
                                    <p><?php echo $ext->label;?><span><?php echo $ext->value;?></span></p>
                                </li>
                                <?php }?>
                                
                            </ul>
                        </div>
                    </div>










                    <div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="location-tab">
                        <div class="map-div">
                            <p> <i class="fa-solid fa-location-dot"></i> {{$vehicletypecars->countryname}}, {{$vehicletypecars->placename}}</p>
                            <?php if ($vehicletypecars->placename=='Ajman'){?>
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d57663.8079630947!2d55.47862375261173!3d25.405212352623007!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f5764dd8fbe79%3A0xcda090de6445a819!2sAjman%20-%20United%20Arab%20Emirates!5e0!3m2!1sen!2sin!4v1652016178959!5m2!1sen!2sin"
                                style="border:0;" class="map-frame" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
<?php } else {?>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d462560.3011825634!2d54.94728643259635!3d25.076381472192086!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f43496ad9c645%3A0xbde66e5084295162!2sDubai%20-%20United%20Arab%20Emirates!5e0!3m2!1sen!2sin!4v1657119647935!5m2!1sen!2sin" width="600" height="450" style="border:0;" class="map-frame" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-section">
        <a id="jump"><p class="section-title">Enquire Now</p></a>
        <p class="desc">
            {{$contents->enquiryContent}}
        </p>
        <div class="form-div">
            <form action="#" id="frm" class="contact-form">
                @csrf
                <input type="hidden" value="{{$vehicletypecars->mainid1}}" class="form-control" id="vehicleid" name="vehicleid" required>
                <div class="input-div">
                    <div class="form-group">
                        <label for="">Full Name</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" required>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>
                <div class="input-div">
                    <div class="form-group">
                        <label for="">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>
                </div>
                <div class="input-div">
                    <div class="form-group">
                        <label for="">Message</label>
                        <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
                    </div>
                </div>
                <div class="input-div checkbox-div">
                    <div class="form-group">
                        <input type="checkbox" id="terms" required>
                        <label for="terms"> <span>Accept <a href="#"> terms & conditions</a></span> </label>
                    </div>
                </div>
                <div class="input-div">
                    <button class="btn send-btn"><span>SEND MESSAGE</span></button>
                </div>
            </form>
        </div>
    </section>

    <button class="btn back-to-up-btn rounded-circle position-fixed bottom-0 end-0 translate-middle d-none"
        onclick="scrollToTop()" id="back-to-up">
        <i class="fa-solid fa-chevron-up" aria-hidden="true"></i>
    </button>
    <!-- Footer-->
    <section class="footer-section px-md-5">
        @include('cars.footer')
    </section>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 plug in JS -->
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <!-- Slick js -->
    
    <script src="{{asset('car/slick/slick.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('car/js/fotorama.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Core theme JS-->
    
    <script src="{{asset('car/js/scripts.js')}}"></script>
    <script>
        $('iframe').contents().find('video').css({
            opacity: 0,
            color: 'purple'
        });
    </script>

    <script>
        $('.fotorama').fotorama({
            allowfullscreen: true,
            nav: 'thumbs',
            arrows: true,
            thumbwidth: 145,
            thumbheight: 99,
            allowfullscreen: true,
        });

$('form').bind('submit', function () {
          $.ajax({
            type: 'post',
            url: '/enquiryprocess',
            data: $('form').serialize(),
            dataType : 'json',
            success: function (data) {             
            if (data.status==200){           
              Swal.fire('Enquiry Send Successfully');
              }
              else{
                Swal.fire('Sorry Enquiry not Send');
              }              
              $("#fullname").val('');
              $("#email").val('');
              $("#subject").val('');
              $("#message").val('');
              $("#terms").prop('checked', false); 
            }
          });
          return false;
        });








    </script>

</body>

</html>