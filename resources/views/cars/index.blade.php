<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Home</title>
  <!-- Favicon-->
  <!--<link rel="icon" type="image/x-icon" href="assets/images/logo.png" />-->
  <!-- Bootstrap icons-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link rel="stylesheet" type="text/css" href="{{ url('car/css/styles.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ url('car/css/main.css') }}" />
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Select2 Plugin css -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <!-- Slick slider -->
  
 <link rel="stylesheet" type="text/css" href="{{ url('car/css/slick/slick.css') }}" />
 <link rel="stylesheet" type="text/css" href="{{ url('car/css/slick/slick-theme.css') }}" />
<style>

  <?php  
  $url=$bannerfirst->image;
  ?>
.gvr-header {
  height: 90vh;  
  /*background-image: url("/car/assets/images/header.png"); */
  background-image: url("{{ url($url) }}");
  background-size: cover;
  box-shadow: inset 0 0 0 2000px rgba(0, 0, 0, 0.25);
}

</style>

</head>

<body>
  <!-- Navigation-->  
  <nav class="navbar navbar-expand-lg navbar-light bg-light gvr-navbar">
    <div class="container-fluid px-4 px-lg-5">
      <a class="navbar-brand" href="index.html">
        <!--<img src="assets/images/logo.png" class="navbar-logo" alt="Company logo" />-->
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="menu-div d-flex">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
            <li class="nav-item  active">
              <a class="nav-link" aria-current="page" href="#!">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">Category</a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <div class="flex-menu d-flex">
                  <div class="leftside">
                    <ul>
                      <li>
                        <a class="dropdown-item" href="#!">All Products</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="#!">Popular Items</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="#!">New Arrivals</a>
                      </li>
                    </ul>
                  </div>
                  <div class="rightside">
                    <p>test</p>
                  </div>
                </div>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#!">Whats's my car worth?</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#!">Why Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#!">Contact Us</a>
            </li>
          </ul>

        </div>
      </div>


      <div class="btn-div">
        <ul class="navbar-nav d-flex">
          <li class="nav-item my-auto">
            <a href="" class="nav-link nav-link-login">Sign in</a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link">
              <button class="btn navbar-btn nav-btn-signup">Signup</button>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="mobile-nav">
      <div class="row m-0">
        <ul class="navbar-nav">
          <li class="active">
            <a href=""> <span><i class="fa-solid fa-home"></i></span> <span>Home</span></a>
          </li>
          <li>
            <div class="dropup">
              <button class="dropbtn"><span><i class="fa-solid fa-layer-group"></i></span><span>Category
                  <!--i
                    class="fa-solid fa-chevron-up"></i-->
                </span></button>
              <div class="dropup-content">
                <a href="#">Link 1</a>
                <a href="#">Link 2</a>
                <a href="#">Link 3</a>
              </div>
            </div>
          </li>
          <li>
            <a href=""> <span><i class="fa-solid fa-wallet"></i></span> <span>Car Worth</span></a>

          </li>
          <li><a href=""> <span><i class="fa fa-circle-question"></i></span> <span>Why Us</span></a> </li>
          <li><a href=""><span><i class="fa-solid fa-address-book"></i></span> <span>Contact</span></a> </li>
        </ul>

      </div>
    </div>
  </nav>

  <!-- Header -->
  <header class="bg-dark gvr-header">
    <div class="container px-4 px-lg-5 h-100">
      <div class="text-center text-white caption-div">
        <p class="lead header-caption mb-0">
          FIND YOUR RIGHT CAR
        </p>
        <p class="header-caption-bold">
          GUARANTEED
        </p>
      </div>
      <div class="search-div">
        <div class="row m-0">
          <div class="col px-0">
            <select id="brand" class="form-control">
              <option>Brand</option>
              <option>Audi</option>
              <option>BMW</option>
              <option>Benz</option>
            </select>
          </div>
          <div class="col px-0">
            <select id="model" class="form-control">
              <option>Model</option>
              <option>Sport</option>
              <option>4x4</option>
              <option>City</option>
            </select>
          </div>
          <div class="col px-0">
            <select id="year" class="form-control">
              <option>Year</option>
              <option>2020</option>
              <option>2021</option>
              <option>2022</option>
            </select>
          </div>
          <div class="col-lg-3 px-0">
            <a href="search.html"><button class="btn header-search-btn">Search</button></a>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Yellow section -->
  <section class="yellow-section">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4">
          <p class="caption-text">Benefits of
            <br />
            <span>
              Buying</span>
            with
            <span class="large-span">COMPANY</span>
          </p>
        </div>
        <div class="col-lg-4">
          <div class="yellow-data-div">
            <div class="icon-div">
              <img src="assets/images/Icons/red-bulb.svg" class="icon" alt="icon">
            </div>
            <div class="desc-div">
              <p class="title">Lorem Ipsum</p>
              <p class="desc">
                Our human resource management information systems in India helps in addition to driving more informed
                decision making, Voyon Folks HCM reduces the time you and your team spend on clerical work
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="yellow-data-div">
            <div class="icon-div">
              <img src="assets/images/Icons/green-bulb.svg" class="icon" alt="icon">
            </div>
            <div class="desc-div">
              <p class="title">Lorem Ipsum</p>
              <p class="desc">
                Our human resource management information systems in India helps in addition to driving more informed
                decision making, Voyon Folks HCM reduces the time you and your team spend on clerical work
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Car list Section-->
  <section class="py-5 home-cars-section">
    <div class="container px-4 px-lg-5 mt-5">
      <p class="section-title">Our
        <span>Cars</span>
      </p>
      <div id="wrapper">
        <ul id="filter">
          <li class="active">All</li>
           @foreach ($vehicletype as $row)
           <li>{{ $row->name }}</li>
           @endforeach
          
        </ul>

        <div class="row" id="portfolio">
          <!-- Car Card -->

          @foreach ($vehicletypecars as $row)
          <div class="all {{ strtolower($row->name) }} col-lg-3 col-md-4 car-card">
            <div class="card h-100">
             
              <a href="details.html">
                <div class="card-body">
                  <div class="price-div">
                    <p class="price">{{ $row->modelname }}</p>
                    <p class="feature-tag">Featured</p>
                  </div>
                  <div class="card-img-div">
                    <img class="card-img img-fluid" src={{asset($row->image) }} alt="card image" />
                  </div>
                  <div class="car-details-div">
                    <div class="car-name-div">
                      <p class="car-name">{{ $row->title }}</p>
                    </div>
                    <div class="car-details">
                      <div class="km-div">
                        <p class="km">
                          <span class="icon-span">
                            <img src="assets/images/Icons/meter.png" class="car-icon" alt="">
                          </span>
                          {{ $row->milage }} KM
                        </p>
                      </div>
                      <div class="year-div">
                        <p class="year">{{ $row->registration_year }}</p>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </a>
            </div>
          </div>
           @endforeach
          <!--<div class="all Sedan col-lg-3 col-md-4 car-card">
            <div class="card h-100">
              
              <a href="details.html">
                <div class="card-body">
                  <div class="price-div">
                    <p class="price">AED 599,000</p>
                    <p class="feature-tag">Featured</p>
                  </div>
                  <div class="card-img-div">
                    <img class="card-img img-fluid" src="assets/images/car.png" alt="card image" />
                  </div>
                  <div class="car-details-div">
                    <div class="car-name-div">
                      <p class="car-name">Mazda Miata</p>
                    </div>
                    <div class="car-details">
                      <div class="km-div">
                        <p class="km">
                          <span class="icon-span">
                            <img src="assets/images/Icons/meter.png" class="car-icon" alt="">
                          </span>
                          2,100 KM
                        </p>
                      </div>
                      <div class="year-div">
                        <p class="year">2016</p>
                      </div>
                    </div>
                   
                  </div>
                </div>
              </a>
            </div>
          </div>
          
          <div class="all suv col-lg-3 col-md-4 car-card">
            <div class="card h-100">
              
              <a href="details.html">
                <div class="card-body">
                  <div class="price-div">
                    <p class="price">AED 599,000</p>
                    <p class="feature-tag">Featured</p>
                  </div>
                  <div class="card-img-div">
                    <img class="card-img img-fluid" src="assets/images/car.png" alt="card image" />
                  </div>
                  <div class="car-details-div">
                    <div class="car-name-div">
                      <p class="car-name">Mazda Miata</p>
                    </div>
                    <div class="car-details">
                      <div class="km-div">
                        <p class="km">
                          <span class="icon-span">
                            <img src="assets/images/Icons/meter.png" class="car-icon" alt="">
                          </span>
                          2,100 KM
                        </p>
                      </div>
                      <div class="year-div">
                        <p class="year">2016</p>
                      </div>
                    </div>
                   
                  </div>
                </div>
              </a>
            </div>
          </div>
          
          <div class="all suv col-lg-3 col-md-4 car-card">
            <div class="card h-100">
              
              <a href="details.html">
                <div class="card-body">
                  <div class="price-div">
                    <p class="price">AED 599,000</p>
                    <p class="feature-tag">Featured</p>
                  </div>
                  <div class="card-img-div">
                    <img class="card-img img-fluid" src="assets/images/car.png" alt="card image" />
                  </div>
                  <div class="car-details-div">
                    <div class="car-name-div">
                      <p class="car-name">Mazda Miata</p>
                    </div>
                    <div class="car-details">
                      <div class="km-div">
                        <p class="km">
                          <span class="icon-span">
                            <img src="assets/images/Icons/meter.png" class="car-icon" alt="">
                          </span>
                          2,100 KM
                        </p>
                      </div>
                      <div class="year-div">
                        <p class="year">2016</p>
                      </div>
                    </div>
                   
                  </div>
                </div>
              </a>
            </div>
          </div>
          
          <div class="all hybrid col-lg-3 col-md-4 car-card">
            <div class="card h-100">
              
              <a href="details.html">
                <div class="card-body">
                  <div class="price-div">
                    <p class="price">AED 599,000</p>
                    <p class="feature-tag">Featured</p>
                  </div>
                  <div class="card-img-div">
                    <img class="card-img img-fluid" src="assets/images/car.png" alt="card image" />
                  </div>
                  <div class="car-details-div">
                    <div class="car-name-div">
                      <p class="car-name">Mazda Miata</p>
                    </div>
                    <div class="car-details">
                      <div class="km-div">
                        <p class="km">
                          <span class="icon-span">
                            <img src="assets/images/Icons/meter.png" class="car-icon" alt="">
                          </span>
                          2,100 KM
                        </p>
                      </div>
                      <div class="year-div">
                        <p class="year">2016</p>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </a>
            </div>
          </div>
          
          <div class="all hybrid col-lg-3 col-md-4 car-card">
            <div class="card h-100">
             
              <a href="details.html">
                <div class="card-body">
                  <div class="price-div">
                    <p class="price">AED 599,000</p>
                    <p class="feature-tag">Featured</p>
                  </div>
                  <div class="card-img-div">
                    <img class="card-img img-fluid" src="assets/images/car.png" alt="card image" />
                  </div>
                  <div class="car-details-div">
                    <div class="car-name-div">
                      <p class="car-name">Mazda Miata</p>
                    </div>
                    <div class="car-details">
                      <div class="km-div">
                        <p class="km">
                          <span class="icon-span">
                            <img src="assets/images/Icons/meter.png" class="car-icon" alt="">
                          </span>
                          2,100 KM
                        </p>
                      </div>
                      <div class="year-div">
                        <p class="year">2016</p>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </a>
            </div>
          </div>
          

          
          <div class="all sport col-lg-3 col-md-4 car-card">
            <div class="card h-100">
              
              <a href="details.html">
                <div class="card-body">
                  <div class="price-div">
                    <p class="price">AED 599,000</p>
                    <p class="feature-tag">Featured</p>
                  </div>
                  <div class="card-img-div">
                    <img class="card-img img-fluid" src="assets/images/car.png" alt="card image" />
                  </div>
                  <div class="car-details-div">
                    <div class="car-name-div">
                      <p class="car-name">Mazda Miata</p>
                    </div>
                    <div class="car-details">
                      <div class="km-div">
                        <p class="km">
                          <span class="icon-span">
                            <img src="assets/images/Icons/meter.png" class="car-icon" alt="">
                          </span>
                          2,100 KM
                        </p>
                      </div>
                      <div class="year-div">
                        <p class="year">2016</p>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </a>
            </div>
          </div>
          
          <div class="all sport col-lg-3 col-md-4 car-card">
            <div class="card h-100">
              
              <a href="details.html">
                <div class="card-body">
                  <div class="price-div">
                    <p class="price">AED 599,000</p>
                    <p class="feature-tag">Featured</p>
                  </div>
                  <div class="card-img-div">
                    <img class="card-img img-fluid" src="assets/images/car.png" alt="card image" />
                  </div>
                  <div class="car-details-div">
                    <div class="car-name-div">
                      <p class="car-name">Mazda Miata</p>
                    </div>
                    <div class="car-details">
                      <div class="km-div">
                        <p class="km">
                          <span class="icon-span">
                            <img src="assets/images/Icons/meter.png" class="car-icon" alt="">
                          </span>
                          2,100 KM
                        </p>
                      </div>
                      <div class="year-div">
                        <p class="year">2016</p>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </a>
            </div>
          </div>-->
          <!-- Car Card Ends -->

          <!-- Show all button div -->
          <div class="col-12 show-btn-div">
            <button class="btn show-all-btn">Show All</button>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Video section -->
  <section class="video-section">
    <div class="button-div">
      <button class="btn play-btn" data-bs-toggle="modal" data-bs-target="#myModal"><i
          class="fa-regular fa-circle-play"></i>
      </button>
      <p class="watch-text">Watch Video</p>

    </div>
    <div class="image-div">
      <img src="assets/images/video-banner.png" class="img-fluid" alt="">
    </div>

    <!-- Video Modal -->
    <div class="modal centered" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
      aria-hidden="true">
      <div class="aligner">
        <div class="modal-dialog modal-lg">
          <div class="modal-content bg-dark">
            <div class="modal-header p-0 border-0 d-block text-end me-3 pt-2">
              <button type="button" class="close btn bg-transparent text-white" data-bs-dismiss="modal"><span
                  aria-hidden="true">&times;</span><span class="sr-only">Close</span> </button>
            </div>
            <div class="modal-body">
              <video controls style="width: 100%; height: auto" id="videoModal" poster="assets/images/header-old.jpeg"
                preload>
                <source src="assets/video.mp4" type="video/mp4" />
              </video>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Video modal ends -->
    </div>
    </div>
  </section>

  <!-- Brand Section -->
  <section class="brand-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-2 col-md-12 col-12 mt-auto">
          <p class="section-title pb-0 mb-0">Our<span class="ms-2">Brands</span></p>
        </div>
        <div class="col-lg-10 col-md-12 col-12">
          <div class="brand-carousel">
            <!-- Inside the containing div, add one div for each slide -->
            @foreach ($brands as $row)
            <div>
              <img src="{{ asset($row->dealer_image) }}" class="img-fluid brand-logo">
            </div>
            @endforeach
           
          </div>

        </div>
      </div>
    </div>
  </section>

  <!-- Special offer section -->
  <section class="special-section">
    <div class="row mx-0">
      <div class="col-lg-5 col-md-12 col-12 p-0">
        <div class="image-div">
          <p class="main-heading">LIMITED SPECIAL OFFER</p>
          <p class="desc">LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT, SED DO UT ENIM AD MINIM VENIAM, QUIS
            NOSTRUD</p>
        </div>
        <!-- <img src="assets/images/special-offer.png" class="special-img img-fluid" alt="special offer image"> -->
      </div>
      <div class="col-lg-7 col-md-12 col-12 accordion-div">
        <div class="row heading-row">
          <p class="sub-heading">OUR ADVANTAGES YOU NEED TO KNOW</p>
          <p class="main-heading"><span>125</span>K+ HAPPY CLIENTS</p>
          <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do Ut enim ad minim veniam, quis
            nostrud</p>
        </div>




         
        <div class="row">
          <div class="col-lg-8">
            <div class="accordion special-accordion" id="accordionExample">
              <?php $i=0;
$k=1;
              ?>
              @foreach($questions as $row)
         
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne<?php echo $i?>">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?php echo $i?>"
                    aria-expanded="true" aria-controls="collapseOne<?php echo $i?>">
                    <span></span>
                    <div class="button-text d-flex">
                      <div class="count-div">
                        <p class="count"><?php echo $k++;?></p>
                      </div>
                      <div class="text-div">
                        <p class="text">{{$row->question}}</p>
                      </div>
                    </div>
                  </button>
                </h2>

<?php if ($i==0){
  $show='show';
}
else{
  $show='';
}
?>
                <div id="collapseOne<?php echo $i?>" class="accordion-collapse collapse <?php echo $show;?>" aria-labelledby="headingOne<?php echo $i?>"
                  data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <div class="desc-div">
                      <span class="left-element">&nbsp;</span>

                      <p class="light-desc">{{$row->shortdescription}}</p>
                      <p class="desc">
                       {{$row->answer}}
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <?php $i++;?>
              @endforeach
              
            </div>
          </div>
          <div class="col-lg-4 special-car-div">
            <img src="assets/images/special-car.png" class="img-fluid" alt="special car image">
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="testimonial-section">
    <div class="testimonial-container container">
      <div class="testimonial-carousel">
        @foreach ($testimonial as $row)
        <div class="testimonial">
          <div class="quote-icon">
            <img src="assets/images/Icons/quote.png" class="img-fluid quote-img" alt="" srcset="">
          </div>
          <p class="desc">
            {{ $row->description }}
          </p>
          <p class="client-name">
            {{ $row->name }}, <span>{{ $row->designation }}</span>
          </p>
        </div>
        @endforeach
       
      </div>

      <div class="image-div">
        <img src="assets/images/testimonial-car.png" class="testimonial-banner" alt="testimonial car">
      </div>
    </div>
  </section>

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
  
<script src="{{ asset('car/css/slick/slick.min.js') }}"></script>
  <!-- Core theme JS-->
  

<script src="{{ asset('car/js/scripts.js') }}"></script>

</body>

</html>