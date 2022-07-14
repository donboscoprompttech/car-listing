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
    <link rel="stylesheet" type="text/css" href="{{ url('car/css/developer.css') }}" />
<style>
  <?php  
  $url=$searchresult->image;
  $urlfooter=$footerimg->image;
  $urlquestion1=$question1img->image;
  ?>
.listing-header {
  background: url("{{ url($url) }}");
  height: 70%;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
.special-section .image-div {
  background-image:url("{{ url($urlquestion1) }}");;
  background-size: cover;
  background-repeat: no-repeat;
  height: 100%;
  background-position: center;
  object-fit: cover;
  width: 100%;
  font-family: "Montserrat", sans-serif;
  color: #ffffff;
}
#loadingDiv{position:fixed;top:0px;right:0px;width:100%;height:100%;
    background-color:#666;
    /*background-image:url('http://dummyimage.com/64x64/000/fff.gif&text=LOADING');*/
    background-image:url("{{'/car/assets/images/loading.gif'}}"); 
    background-repeat:no-repeat;
    background-position:center;
    z-index:10000000;  opacity: 0.4;
    filter: alpha(opacity=40); /* For IE8 and earlier */}

 .pagination{
            float: right;
            margin-top: 10px;
        }
        .page-link{
            color:#1d1d1d;background-color:#f0d32f ;border-color:#f0d32f ;
        }
        .page-item.active .page-link {
  z-index: 3;
  color: #000;
  background-color: #ffffff;
  border-color: #f0d32f;
}

    
</style>

</head>

<body>
  <!-- Navigation-->
   
   <div id="loadingDiv">
    <div>
        <h7>Please wait...</h7>
        
    </div></div>  
       @include('cars.header')
  <!-- Header -->
  <header class="bg-dark gvr-header listing-header">
    <div class="container px-4 px-lg-5 h-100">
      <div class="text-center text-white caption-div">
        <p class="lead header-caption mb-0">
           {{$contents->firstpagebannertitle1}}
        </p>
        <p class="desc"> {{$contents->secondpagebannertitle2}},
          {{$contents->secondpagebannertitle3}} </p>
      </div>

      <div class="toggle-div">
        <div class="toggle-switch">
          <label class="toggle-switch-light" >
            <input type="checkbox" checked>
            <span>
              <span onclick="clicked('Sold')">Sold</span>
              <span onclick="clicked('Reserved')">Reserved</span>
            </span>
            <a class="btn btn-primary"></a>
            </input>
          </label>
        </div>
      </div>
      <div class="search-div">
        <form action="{{ url('/searchresult') }}" method="get">
          @csrf<input type="hidden" name="pageflag" value="2">
          <input type="hidden" name="priceflag" id="priceflag" value="0">
        <div class="row m-0">
          <div class="col-lg-2 col-12 px-0 mb-lg-0 mb-2">
            <span class="select-title-head">Make</span>
              <select id="brand" class="form-control" name="make">
              <option value="0">Make</option>
               @foreach ($make as $row)
              <option value="{{ $row->make_id }}" <?php if($make1==$row->make_id){?> selected <?php }?>>{{ $row->makename }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-lg-2 col-12 px-0 mb-lg-0 mb-2">
            <span class="select-title-head">Model</span>
             <select id="model" class="form-control" name="model">
              <option value="0">Model</option>
              @foreach ($model as $row)
              <option value="{{ $row->model_id }}" <?php if($model1==$row->model_id){?> selected <?php }?>>{{ $row->modelname }}</option>
              @endforeach
             
            </select>
          </div>
          <div class="col-lg-2 col-12 px-0 mb-lg-0 mb-2">
            <span class="select-title-head">Year</span>
            <select id="year" class="form-control" name="year">
              <option value="0">Year</option>
              @foreach ($year as $row)
              <option value="{{ $row->registration_year }}" <?php if($year1==$row->registration_year){?> selected <?php }?>>{{ $row->registration_year }}</option>
              @endforeach
              
            </select>
          </div>
          <div class="col-lg-2 col-12 px-0 range-div">
            <p class="range-title">Price Range</p>
            <p class="range-value">
              <input type="text" id="amount" class="filterAmount"  name="amount" readonly>
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
                <input type="text" name="keywordsearch" class="form-control search-input" placeholder="Keyword Search" />
              </div>
              <div class="col-lg-2 col-12">
                <button class="btn header-search-btn" type="submit">Search</button>
              </div>
            </div>
          </div>
        </div></form>
      </div>

    </div>
  </header>

  <!-- Recommended section -->
  <section class="recommend-section">
    <div class="container">
      <div class="tab-div">
        <p class="section-title">Search Result</p>
        <div class="list-tab-div">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#new" type="button"
                role="tab" aria-controls="home" aria-selected="true">Used</button>
            </li>
            <!--<li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#used" type="button"
                role="tab" aria-controls="profile" aria-selected="false">New</button>
            </li>-->
            <li class="more-link"><a href="category/All"><button class="nav-link">See more <i
                    class="fa-solid fa-chevron-right"></i></button></a></li>
          </ul>
        </div>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="new" role="tabpanel" aria-labelledby="new-tab">
            <div class="container-fluid home-cars-section card-listing-div">
              <div class="row search-card-row sertab">
                <!-- Car Card -->
                <?php if (count($vehicletypecars)==0){ echo "Sorry no records found";}?>
                @foreach ($vehicletypecars as $row)

                <?php if ($row->type1==1){?>
                <div class="col-lg-4 col-md-6 car-card">
                  <div class="card h-100">
                     <a href="/details/{{ $row->mainid}}">
                      <div class="card-body">

                        <div class="card-img-div">
                         <img class="card-img img-fluid" src="{{asset($row->image) }}"
                            alt="card image" />
                          <!--<div class="ribbon featured"><span>{{--- $row->soldreserved----}}</span></div>-->
<?=($row->soldreserved!="None")?'<div class="ribbon featured"><span>'.$row->soldreserved.'</span></div>':''?>



                        </div>
                        <div class="car-details-div">
                          <div class="tag-div">
                            <p>{{$row->uniquenumber}}</p>
                          </div>
                          <div class="car-name-div">
                            <p class="car-name">{{ $row->title }}</p>
                          </div>
                          <div class="price-div">
                            <p class="price">AED{{number_format($row->price)}} <span class="strike-price">AED {{number_format($row->price)}}</span></p>
                          </div>
                          <div class="car-details">
                            <p class="location w-100">{{$row->placename}},{{$row->countryname}}</p>

                            <div class="info-div row">
                              <div class="col-lg-5 col-5">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/calendar.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> {{$row->registration_year}}</p>
                              </div>
                              <div class="col-lg-7 col-7">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/wheel.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> {{$row->drive}}</p>
                              </div>
                              <div class="col-lg-5 col-5">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/fuel.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> {{$row->fuel_type}}</p>
                              </div>
                              <div class="col-lg-7 col-7">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/people.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> {{$row->seats}}</p>
                              </div>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                    </a>
                  </div>
                </div>

<?php }?>
                @endforeach
                
<nav aria-label="Page navigation example"> 
<br>

<div id="pagination">
  
  {{$vehicletypecars->appends(Request::except('page'))->render()}}
</div>
                       </nav>

                <!-- Show all button div -->
                <div class="col-12 show-btn-div">
                   <a href="category/All"><button class="btn show-all-btn">Show All</button></a>
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
          <p class="main-heading">{{$contents->bottompagelefttitle}}</p>
          <p class="desc">{{$contents->bottompageleftcontent}}</p>
        </div>
        <!-- <img src="assets/images/special-offer.png" class="special-img img-fluid" alt="special offer image"> -->
      </div>
      <div class="col-lg-7 col-md-12 col-12 accordion-div">
        <div class="row heading-row">
          <p class="sub-heading">{{$contents->bottompagerighttitle}}</p>
          <p class="main-heading"><!--<span>125</span>-->{{$contents->bottompagerightContent}}</p>
          <p class="desc">{{$contents->faqContent}}</p>
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
            <img src="{{url($question2img->image)}}" class="img-fluid" alt="special car image">
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
        <img src={{ url($urlfooter) }} class="testimonial-banner" alt="testimonial car">
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
  <script>  
$(function() {
    $("#loadingDiv").hide();
});


  // Make Change
      $('#brand').change(function(){
$("#loadingDiv").show();
         // Department id
         var id = $(this).val();

         // Empty the dropdown
         $('#model').find('option').not(':first').remove();

         // AJAX request 
         $.ajax({
           url: 'getModel/'+id,
           type: 'get',
           dataType: 'json',
           success: function(response){

             var len = 0;
             if(response['data'] != null){
                len = response['data'].length;
             }

             if(len > 0){
                // Read data and create <option >
                for(var i=0; i<len; i++){

                   var id = response['data'][i].id;
                   var name = response['data'][i].name;

                   var option = "<option value='"+id+"'>"+name+"</option>";

                   $("#model").append(option); 
                }
                $("#loadingDiv").hide(); 
             }else{
$("#loadingDiv").hide(); 
             }

           }
         });});


      <?php 

       //echo $maxprice['price'];?>
      $(function() {
  $( ".range-bar" ).slider({
    range: true,
    min: <?php echo $minprice[0]->price;?>,
    max: <?php echo $maxprice[0]->price;?>,
    values: [ 0, <?php echo $maxprice[0]->price;?> ],
    slide: function( event, ui ) {
    $( ".filterAmount" ).val( "AED" + ui.values[ 0 ] + " - AED" + ui.values[ 1 ] );
    }
  });
  $( ".filterAmount" ).val( "AED" + $( ".range-bar" ).slider( "values", 0 ) +
    " -AED" + $( ".range-bar" ).slider( "values", 1 ) );
});
$(function() {    // <== doc ready

    $( "#slider-range" ).slider({
       change: function(event, ui) {
           // Do your stuff in here.

           // You can trigger an event on anything you want:
           //$(selector).trigger(theEvent);

           // Or you can do whatever else/
var low = $(this).slider('values', 0);

            var high = $(this).slider('values', 1);

$("#priceflag").val(1);

       }
    });

});
function clicked(val){
$("#loadingDiv").show();
 $.ajax({
           url: 'getVehicles',
           type: 'get',
           dataType: 'html',
           data:{val:val},
           success: function(response){
$(".sertab").html(response);
$("#loadingDiv").hide(); 
             }
});



}
    </script>
</body>

</html>