<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Search Result</title>
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

  <!-- Slick slider -->
  <link href="{{ asset('/car/css/slick/slick.css') }}" rel="stylesheet"> 
    <link href="{{ asset('/car/css/slick/slick-theme.css') }}" rel="stylesheet">


</head>

<body>
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light gvr-navbar">
    <div class="container-fluid px-4 px-lg-5">
      <a class="navbar-brand" href="index.html">
       
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
                  @include('cars.header')

      </div>
    </div>
  </nav>

  <!-- Header -->
  <header class="bg-dark gvr-header listing-header">
    <div class="container px-4 px-lg-5 h-100">
      <div class="text-center text-white caption-div">
        <p class="lead header-caption mb-0">
          Find your dream car
        </p>
        <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
      </div>

      <div class="toggle-div">
        <div class="toggle-switch">
          <label class="toggle-switch-light" onclick="">
            <input type="checkbox" checked>
            <span>
              <span>Rent</span>
              <span>Sale</span>
            </span>
            <a class="btn btn-primary"></a>
            </input>
          </label>
        </div>
      </div>
      <div class="search-div">
        <div class="row m-0">
          <div class="col-lg-2 col-12 px-0 mb-lg-0 mb-2">
            <span class="select-title-head">Brand</span>
            <select id="brand" class="form-control">
              <option>Brand</option>
              <option>Audi</option>
              <option>BMW</option>
              <option>Benz</option>
            </select>
          </div>
          <div class="col-lg-2 col-12 px-0 mb-lg-0 mb-2">
            <span class="select-title-head">Model</span>
            <select id="model" class="form-control">
              <option>Model</option>
              <option>Sport</option>
              <option>4x4</option>
              <option>City</option>
            </select>
          </div>
          <div class="col-lg-2 col-12 px-0 mb-lg-0 mb-2">
            <span class="select-title-head">Year</span>
            <select id="year" class="form-control">
              <option>Year</option>
              <option>2020</option>
              <option>2021</option>
              <option>2022</option>
            </select>
          </div>
          <div class="col-lg-2 col-12 px-0 range-div">
            <p class="range-title">Price Range</p>
            <p class="range-value">
              <input type="text" id="amount" class="filterAmount" readonly>
            </p>
          </div>
          <div class="col-lg-4 col-12 px-0 my-auto">
            <div class="price-range-slider">
              <div id="slider-range" class="range-bar"></div>
            </div>
          </div>
          <div class="col-lg-12 px-0">
            <div class="row px-0">
              <div class="col-lg-10 col-12">
                <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input type="text" class="form-control search-input" placeholder="Keyword Search" />
              </div>
              <div class="col-lg-2 col-12">
                <a href="result.html"><button class="btn search-btn">Search</button></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Recommended section -->
  <section class="recommend-section">
    <div class="container">
      <div class="tab-div">
        <p class="section-title">Recommended Cars</p>
        <div class="list-tab-div">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#new" type="button"
                role="tab" aria-controls="home" aria-selected="true">New</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#used" type="button"
                role="tab" aria-controls="profile" aria-selected="false">Used</button>
            </li>
            <li class="more-link"><a href="listing.html"><button class="nav-link">See more <i
                    class="fa-solid fa-chevron-right"></i></button></a></li>
          </ul>
        </div>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="new" role="tabpanel" aria-labelledby="new-tab">
            <div class="container-fluid home-cars-section card-listing-div">
              <div class="row search-card-row">
                <!-- Car Card -->
                <div class="col-lg-4 col-md-6 car-card">
                  <div class="card h-100">
                    <a href="details.html">
                      <div class="card-body">

                        <div class="card-img-div">
                         <img class="card-img img-fluid" src="{{ asset('car/assets/images/listing/search/Tesla.png') }}"
                            alt="card image" />
                          <div class="ribbon featured"><span>Featured</span></div>
                        </div>
                        <div class="car-details-div">
                          <div class="tag-div">
                            <p>NEW</p>
                          </div>
                          <div class="car-name-div">
                            <p class="car-name">Tesla Model 3 Standard Range
                              Plus</p>
                          </div>
                          <div class="price-div">
                            <p class="price">AED 599,000 <span class="strike-price">AED 83,500</span></p>
                          </div>
                          <div class="car-details">
                            <p class="location w-100">Dubai, UAE</p>

                            <div class="info-div row">
                              <div class="col-lg-5 col-5">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/calendar.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> 2020</p>
                              </div>
                              <div class="col-lg-7 col-7">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/wheel.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> Rear-wheel Drive</p>
                              </div>
                              <div class="col-lg-5 col-5">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/fuel.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> Electric</p>
                              </div>
                              <div class="col-lg-7 col-7">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/people.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> 5</p>
                              </div>
                            </div>
                          </div>
                          <!-- Product price-->
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
                <!-- Car Card Ends -->

                <!-- Car Card -->
                <div class="col-lg-4 col-md-6 car-card">
                  <div class="card h-100">
                    <a href="details.html">
                      <div class="card-body">

                        <div class="card-img-div">
                          <img class="card-img img-fluid" src="{{ asset('car/assets/images/listing/search/Ford.png') }}"
                            alt="card image" />
                          <div class="ribbon booked"><span>Booked</span></div>
                        </div>
                        <div class="car-details-div">
                          <div class="tag-div">
                            <p>NEW</p>
                          </div>
                          <div class="car-name-div">
                            <p class="car-name">Ford F-250 Super Duty</p>
                          </div>
                          <div class="price-div">
                            <p class="price">AED 599,000 <span class="strike-price">AED 83,500</span></p>
                          </div>
                          <div class="car-details">
                            <p class="location w-100">Dubai, UAE</p>

                            <div class="info-div row">
                              <div class="col-lg-5 col-5">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/calendar.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> 2020</p>
                              </div>
                              <div class="col-lg-7 col-7">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/wheel.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> Rear-wheel Drive</p>
                              </div>
                              <div class="col-lg-5 col-5">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/fuel.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> Electric</p>
                              </div>
                              <div class="col-lg-7 col-7">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/people.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> 5</p>
                              </div>
                            </div>
                          </div>
                          <!-- Product price-->
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
                <!-- Car Card Ends -->

                <!-- Car Card -->
                <div class="col-lg-4 col-md-6 car-card">
                  <div class="card h-100">
                    <a href="details.html">
                      <div class="card-body">

                        <div class="card-img-div">
                          <img class="card-img img-fluid" src="{{ asset('car/assets/images/listing/search/Honda.png') }}"
                            alt="card image" />
                        </div>
                        <div class="car-details-div">
                          <div class="tag-div">
                            <p>NEW</p>
                          </div>
                          <div class="car-name-div">
                            <p class="car-name">Honda Pilot Touring 7-Passenger</p>
                          </div>
                          <div class="price-div">
                            <p class="price">AED 599,000 <span class="strike-price">AED 83,500</span></p>
                          </div>
                          <div class="car-details">
                            <p class="location w-100">Dubai, UAE</p>

                            <div class="info-div row">
                              <div class="col-lg-5 col-5">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/calendar.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> 2020</p>
                              </div>
                              <div class="col-lg-7 col-7">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/wheel.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> Rear-wheel Drive</p>
                              </div>
                              <div class="col-lg-5 col-5">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/fuel.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> Electric</p>
                              </div>
                              <div class="col-lg-7 col-7">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/people.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> 5</p>
                              </div>
                            </div>
                          </div>
                          <!-- Product price-->
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
                <!-- Car Card Ends -->
                <!-- Car Card -->
                <div class="col-lg-4 col-md-6 car-card">
                  <div class="card h-100">
                    <a href="details.html">
                      <div class="card-body">

                        <div class="card-img-div">
                          <img class="card-img img-fluid" src="{{ asset('car/assets/images/listing/search/Tesla.png') }}"
                            alt="card image" />
                          <div class="ribbon featured"><span>Featured</span></div>
                        </div>
                        <div class="car-details-div">
                          <div class="tag-div">
                            <p>NEW</p>
                          </div>
                          <div class="car-name-div">
                            <p class="car-name">Tesla Model 3 Standard Range
                              Plus</p>
                          </div>
                          <div class="price-div">
                            <p class="price">AED 599,000 <span class="strike-price">AED 83,500</span></p>
                          </div>
                          <div class="car-details">
                            <p class="location w-100">Dubai, UAE</p>

                            <div class="info-div row">
                              <div class="col-lg-5 col-5">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/calendar.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> 2020</p>
                              </div>
                              <div class="col-lg-7 col-7">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/wheel.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> Rear-wheel Drive</p>
                              </div>
                              <div class="col-lg-5 col-5">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/fuel.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> Electric</p>
                              </div>
                              <div class="col-lg-7 col-7">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/people.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> 5</p>
                              </div>
                            </div>
                          </div>
                          <!-- Product price-->
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
                <!-- Car Card Ends -->

                <!-- Car Card -->
                <div class="col-lg-4 col-md-6 car-card">
                  <div class="card h-100">
                    <a href="details.html">
                      <div class="card-body">

                        <div class="card-img-div">
                          <img class="card-img img-fluid" src="{{ asset('car/assets/images/listing/search/Ford.png') }}"
                            alt="card image" />
                          <div class="ribbon booked"><span>Booked</span></div>
                        </div>
                        <div class="car-details-div">
                          <div class="tag-div">
                            <p>NEW</p>
                          </div>
                          <div class="car-name-div">
                            <p class="car-name">Ford F-250 Super Duty</p>
                          </div>
                          <div class="price-div">
                            <p class="price">AED 599,000 <span class="strike-price">AED 83,500</span></p>
                          </div>
                          <div class="car-details">
                            <p class="location w-100">Dubai, UAE</p>

                            <div class="info-div row">
                              <div class="col-lg-5 col-5">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/calendar.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> 2020</p>
                              </div>
                              <div class="col-lg-7 col-7">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/wheel.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> Rear-wheel Drive</p>
                              </div>
                              <div class="col-lg-5 col-5">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/fuel.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> Electric</p>
                              </div>
                              <div class="col-lg-7 col-7">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/people.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> 5</p>
                              </div>
                            </div>
                          </div>
                          <!-- Product price-->
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
                <!-- Car Card Ends -->

                <!-- Car Card -->
                <div class="col-lg-4 col-md-6 car-card">
                  <div class="card h-100">
                    <a href="details.html">
                      <div class="card-body">

                        <div class="card-img-div">
                          <img class="card-img img-fluid" src="{{ asset('car/assets/images/listing/search/Honda.png') }}"
                            alt="card image" />
                        </div>
                        <div class="car-details-div">
                          <div class="tag-div">
                            <p>NEW</p>
                          </div>
                          <div class="car-name-div">
                            <p class="car-name">Honda Pilot Touring 7-Passenger</p>
                          </div>
                          <div class="price-div">
                            <p class="price">AED 599,000 <span class="strike-price">AED 83,500</span></p>
                          </div>
                          <div class="car-details">
                            <p class="location w-100">Dubai, UAE</p>

                            <div class="info-div row">
                              <div class="col-lg-5 col-5">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/calendar.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> 2020</p>
                              </div>
                              <div class="col-lg-7 col-7">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/wheel.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> Rear-wheel Drive</p>
                              </div>
                              <div class="col-lg-5 col-5">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/fuel.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> Electric</p>
                              </div>
                              <div class="col-lg-7 col-7">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/people.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> 5</p>
                              </div>
                            </div>
                          </div>
                          <!-- Product price-->
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
                <!-- Car Card Ends -->


                <!-- Show all button div -->
                <div class="col-12 show-btn-div">
                  <button class="btn show-all-btn">Show All</button>
                </div>
              </div>

            </div>
          </div>
          <div class="tab-pane fade" id="used" role="tabpanel" aria-labelledby="used-tab">...</div>
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
            <img src="{{ asset('car/assets/images/special-car.png') }}" class="img-fluid" alt="special car image">
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
            <img src="{{ asset('car/assets/images/Icons/quote.png') }}" class="img-fluid quote-img" alt="" srcset="">
          </div>
          <p class="desc">
            {{ $row->description }}
          </p>
          <p class="client-name">
            {{ $row->name }},<span>{{ $row->designation }}</span>
          </p>
        </div>
        @endforeach
       
      </div>

      <div class="image-div">
        <img src="{{ asset('car/assets/images/testimonial-car.png') }}" class="testimonial-banner" alt="testimonial car">
      </div>
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
 
  <script src="{{asset('car/css/slick/slick.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>

  <!-- Core theme JS-->
  <script src="{{asset('car/js/scripts.js')}}"></script>
</body>

</html>